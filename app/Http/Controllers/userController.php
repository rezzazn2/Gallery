<?php

namespace App\Http\Controllers;

use App\Models\Foto;
use App\Models\komentarFoto;
use App\Models\laporan;
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



    public function modalPreviewFoto(Request $request){
        $id = $request->input('id');
        $data = $this->data;
        $data["foto"] = Foto::where('id', $id)->get()->first();

        return view('gallery.modal.modal-preview-foto', $data);
    }

    public function konfirmasiLapor(Request $request){
        $id = $request->input('id');

        $laporan = laporan::where('id', $id)->first();
        if($laporan){
            $idFoto = $laporan->foto_id;
            $foto = Foto::where('id', $idFoto);
            if ($foto) {


                $filePath = public_path('storage/foto/' . $foto->first()->jalurFoto);
                $foto->delete();

                if (file_exists($filePath)) {
                    unlink($filePath);
                }

            }
        }








        session()->flash('success', 'Foto berhasil dihapus');
        return response()->json(['success' => 'Photo deleted successfully']);
    }







    public function hapuslapor(Request $request){
        $id = $request->input('id');
        $lapor = laporan::find($id);
        if($lapor){
            $lapor->delete();
            return session()->flash('success', 'Laporan berhasil dihapus.');
        }
    }
    public function hapusKomen(Request $request){
        $id = $request->input('id');
        $komen = komentarFoto::find($id);
        if($komen){
            $komen->delete();
            return session()->flash('success', 'Komentar berhasil dihapus.');
        }
    }
    public function editKomentar(Request $request){
        $id = $request->input('id');
        $isi = $request->input('isiKomentar');
        $komen = komentarFoto::find($id);
        $komen->isiKomentar = $isi;

        $komen->save();
        session()->flash('success', 'komentar berhasil di edit');
        return response()->json(['success' => 'komentar berhasil di edit']);;

    }
    public function modaleditKomen(Request $request){
        $id = $request->input('id');
        $data = $this->data;
        $data["komen"] = komentarFoto::where('id', $id)->get()->first();

        return view('gallery.modal.modal-edit-komen', $data);
    }


    public function modalEditUser(Request $request){
        $id = $request->input('id');
        $data = $this->data;
        $data["dataUser"] = User::where('id', $id)->get()->first();

        return view('gallery.modal.modal-edit-data-user', $data);
    }

    public function modalReport(Request $request){
        $id = $request->input('idfoto');
        $data = $this->data;
        $data["idfoto"] = $id;
        return view('gallery.modal.modal-report', $data);
    }
    public function report(Request $request){
       $report = new laporan();

        if($request->has('reportType')){
            $checkbox = $request->input('reportType');
            $kalimat = '';
            foreach( $checkbox as $check){
                $kalimat .= $check. ',';
        }
    }

    // Cek apakah user mengisi textarea dengan name 'laporan'
    if($request->has('laporan')){
        $laporanText = $request->input('laporan');
        $kalimat .= ' laporan : '. $laporanText;
        // Simpan nilai textarea ke dalam model laporan
    }
    $report->user_id = Auth::id();
    $report->foto_id = $request->input('idfoto');
    $report->laporan = $kalimat;
    // Simpan laporan ke dalam database atau lakukan tindakan sesuai kebutuhan Anda
    $report->save();

    session()->flash('success', 'laporan berhasil dikirim');
    return response()->json(['success' => 'laporan berhasil dikirim']);;



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



            session()->flash('success', 'Data user berhasil diubah');
            return response()->json(['success' => 'Data user berhasil diubah']);;
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
            ->paginate(4);

        }else{
            $data["users"]= User::where('username','like', '%' . $keyword . '%')->paginate(4);
        }



        return view('gallery.search.search-user', $data);
    }

    public function searchLapor(Request $request){
        $keyword = $request->input('keyword');
        $data = $this->data;
        $fotos = Foto::where('judulFoto', 'like', '%' . $keyword . '%')->pluck('id')->toArray();

        // Filter laporan berdasarkan foto_id yang ditemukan
        $data['laporan'] = Laporan::whereIn('foto_id', $fotos)->paginate(4);

        return view('gallery.search.search-lapor', $data);
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
