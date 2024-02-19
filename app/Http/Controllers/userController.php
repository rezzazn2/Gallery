<?php

namespace App\Http\Controllers;

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
    public function editUser(Request $request)
    {

         // Validasi data jika diperlukan
         $request->validate([
            'fotoProfil' => 'image|mimes:jpeg,png,jpg,gif|max:2048', // Contoh validasi untuk gambar
            'username' => 'required',
            'namaLengkap' => 'required',
            'alamat' => 'required',
            'email' => 'required|email'
        ]);

        // Proses pengolahan data
        $user = User::find(Auth::id());
        $user->username = $request->input('username');
        $user->nama = $request->input('namaLengkap');
        $user->alamat = $request->input('alamat');
        $user->email = $request->input('email');

        if ($request->input('passwordLama') && $request->input('passwordBaru')) {
            $request->validate([
                'passwordLama' => 'required_with:passwordBaru',
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

        // Redirect atau berikan respons sesuai kebutuhan
        // session()->flash('success', 'Data user berhasil disimpan.');
        // return redirect()->back();
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
