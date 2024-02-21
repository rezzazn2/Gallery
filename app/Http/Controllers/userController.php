<?php

namespace App\Http\Controllers;

use App\Models\komentarFoto;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class userController extends Controller
{
    public $data;
    public function __construct(request $request)
    {
        // Mendapatkan rute dari URL dan mengisi nilai 'judul'
        $this->data = [
            'judul' => $request->path(),
        ];

    }

    

    public function hapusKomen(Request $request){
        $id = $request->input('id');
        $komen = komentarFoto::find($id);
        if($komen){
            $komen->delete();
            return session()->flash('success', 'Data berhasil disimpan.');
        }
    }
    public function modalEditUser(Request $request){
        $id = $request->input('id');
        $data = $this->data;
        $data["dataUser"] = User::where('id', $id)->get()->first();

        return view('gallery.modal.modal-edit-data-user', $data);
    }
    public function editUser(Request $request)
    {
        if($request->has('id')){
            $id = $request->input('id');
        }else{
            $id = Auth::id();
        }
         // Validasi data jika diperlukan
         $request->validate([
            'fotoProfil' => 'image|mimes:jpeg,png,jpg,gif|max:2048',
            'username' => 'required|unique:users,username,' . $id,
            'namaLengkap' => 'required',
            'alamat' => 'required',
            'email' => 'required|email|unique:users,email,' . $id
        ]);

        // Proses pengolahan data
        $user = User::find($id);

        if($request->input('role')){
            $user->role = $request->input('role');
        }
        $user->username = $request->input('username');
        $user->nama = $request->input('namaLengkap');
        $user->alamat = $request->input('alamat');
        $user->email = $request->input('email');

        if ($request->input('passwordLama') && $request->input('passwordBaru')) {
            $request->validate([
                'passwordLama' => 'required_with:passwordBaru|min:8',
                'passwordBaru' => 'required_with:passwordLama|min:8'
            ]);
            if (Hash::check($request->input('passwordLama'), $user->password)) {
                // Jika password lama cocok, lanjutkan dengan validasi password baru
                $user->password = bcrypt($request->input('passwordBaru'));
            } else {
                // Jika password lama tidak cocok, berikan pesan kesalahan
                return response()->json(['error' => 'Password lama tidak cocok.'], 400);
            }
        }

        // Proses upload foto profil jika ada
        if ($request->hasFile('fotoProfil')) {
            if ($user->fotoProfil != 'default.jpg') {
                $path = public_path('storage/foto/') . $user->fotoProfil;
                if (file_exists($path)) {
                    unlink($path);
                }
            }
            $fotoProfil = $request->file('fotoProfil');
            $filename = $fotoProfil->hashName();
            $fotoProfil->store('foto');
            $user->fotoProfil = $filename;
        }

        $user->save();

        return response()->json(['success' => true]);
    }

    public function getLatestUserData()
    {
        // Ambil data pengguna terbaru dari database atau sumber data lainnya
        $latestUserData = User::find(Auth::id());

        // Kirim data dalam format JSON sebagai respons
        return response()->json($latestUserData);
    }

    public function searchUser(Request $request)
    {
        $keyword = $request->input('keyword');
        $filter = $request->input('filter');
        // Lakukan query pen1carian berdasarkan model Foto Anda
        $data = $this->data;

        if($filter !== 'semua'){
            $data["users"]= User::where('username','like', '%' . $keyword . '%')
            ->where('role', $filter)
            ->get();

        }else{
            $data["users"]= User::where('username','like', '%' . $keyword . '%')->get();
        }



        return view('gallery.search-user', $data);
    }
    public function hapusUser(Request $request)
    {
        $id = $request->input('id');
        $user = User::find($id);

        if($user){
            $user->delete();
            session()->flash('success', 'Data user berhasil dihapus');
            return response()->json(['success' => 'Data user berhasil dihapus']);
        }
    }
}
