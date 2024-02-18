<?php

namespace App\Http\Controllers;

use App\Models\Foto;
use App\Models\LikeFoto;
use App\Models\Album;
use App\Models\album_foto;
use App\Models\komentarFoto;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class searchController extends Controller
{

    public $data;

    public function __construct(request $request)
    {
        // Mendapatkan rute dari URL dan mengisi nilai 'judul'
        $this->data = [
            'judul' => $request->path(),
        ];

    }

    public function search(Request $request)
    {
        $keyword = $request->input('keyword');
        $path =  $request->input('path');

        // Lakukan query pen1carian berdasarkan model Foto Anda
        $data = $this->data;
        if($path == "profil"){
            $data['fotos'] = Foto::where('userId', Auth::id())
            ->where('judulFoto', 'like', '%' . $keyword . '%')->get();

        }else{
            $data['fotos'] = Foto::where('judulFoto', 'like', '%' . $keyword . '%')->get();

        }

        return view('gallery.search', $data);
    }

    public function modalById(Request $request)
    {

        $idFoto = $request->input('idFoto');
        $data = $this->data;

        // Lakukan query pencarian berdasarkan model Foto Anda
        $data['albums'] = Album::where('userId', Auth::id())->get();
        $data['marked'] = Foto::find($idFoto)->albums()->whereIn('album_id', $data['albums']->pluck('id'))->get();


        $data['idfoto'] = $idFoto;

        return view('gallery.modal-simpan', $data);
    }

    public function storeFotoAlbum(Request $request)
    {
        $data = $this->data;

        $idFoto = (int)$request->input('idFoto');
        $idAlbum = (int)$request->input('idAlbum');
        $check = album_foto::where('album_id', $idAlbum)->where('foto_id', $idFoto)->count();

        $data['albums'] = Album::where('userId', Auth::id())->get();
        $data['marked'] = Foto::find($idFoto)->albums()->whereIn('album_id', $data['albums']->pluck('id'))->get();

        $data['idfoto'] = $idFoto;
        $data['idAlbum'] = $idAlbum;

        if($check > 0){
            $album = Album::find($idAlbum);
            $album->fotos()->detach($idFoto);
            $data["button"] = true;
            return view('gallery.modal.button-album', $data);

        }else{
            $album = Album::find($idAlbum);
            $album->fotos()->attach($idFoto);
            $data["button"] = false;
            return view('gallery.modal.button-album', $data);
        }



    }

    public function previewImg(Request $request)
    {
        $data = $this->data;
        $idFoto = $request->input('idFoto');
        $data['modalFoto'] = Foto::where('id', $idFoto)->get();
        $data['albums'] = Album::where('userId', Auth::id())->get();
        $dataId = $request->input('idAlbum');
        $data["albumId"] = $dataId;
        $data["idFoto"] = $idFoto;
        $data["komentars"] = komentarFoto::where('fotoId', $idFoto)->latest()->get();

        return  view('gallery.preview-img', $data);
    }

    public function storeKomentar(Request $request)
    {
        $request->validate([
            'value' => 'required',
        ]);

        $idFoto = $request->input('idFoto');
        $idUser = Auth::id();
        $value = $request->input('value');

        $komentar = new komentarFoto();
        $komentar->fotoId = $idFoto;
        $komentar->userId = $idUser;
        $komentar->isiKomentar = $value;
        $komentar->save();

            // Retrieve the username of the user who posted the comment
        $username = Auth::user()->username;

        // Return the response with the username
        return response()->json(['username' => $username, 'message' => 'Comment added successfully']);

    }

    public function prosesLike(Request $request){
        $idFoto = $request->input('idFoto');
        $idUser = Auth::id();

        $check = likefoto::where('user_id', $idUser)
                            ->where('foto_id', $idFoto)
                            ->first();
        if($check){
            $check->delete();
        }else{
            LikeFoto::create([
                'foto_id' => $idFoto,
                'user_id' => $idUser
            ]);
        }

    }

    public function hapusFoto(Request $request){
        $idFoto = $request->input('idFoto');

        $foto = Foto::where('id', $idFoto);

        if ($foto) {


            $filePath = public_path('storage/foto/' . $foto->first()->jalurFoto);
            $foto->delete();

            if (file_exists($filePath)) {
                unlink($filePath);
            }

            // Add any additional logic or response messages as needed

            return response()->json(['success' => 'Photo deleted successfully']);
        } else {
            return response()->json(['message' => 'Photo not found'], 404);
        }
    }

    public function hapusAlbum(Request $request){
        $idAlbum = $request->input('idAlbum');

        $album = Album::where('id', $idAlbum);

        if ($album) {
            $album->delete();
            return redirect('bookmark')->with('success', 'Album successfully deleted');
        } else {
            return response()->json(['message' => 'Album not found'], 404);
        }
    }

    public function modalEditFoto(Request $request){
        $data = $this->data;
        $idFoto = $request->input('idFoto');
        $data['editFoto'] = Foto::where('id', $idFoto)->get()[0];
        return view('gallery.modal-edit-foto', $data);
    }
    public function modalEditAlbum(Request $request){
        $data = $this->data;
        $idAlbum = $request->input('idAlbum');
        $data['editAlbum'] = Album::where('id', $idAlbum)->get()[0];
        return view('gallery.modal-edit-album', $data);
    }
    public function modalALbum(Request $request){
        $data = $this->data;
        $idAlbum = $request->input('idAlbum');
        $data["fotos"] = Album::where('id', $idAlbum)->first()->fotos ;

        return view('gallery.modal-album', $data);
    }

    public function editFoto(Request $request){
        $request->validate([
            'foto' => 'image|mimes:jpeg,png,jpg,gif|max:10240',
            'judulFoto' => 'required|max:255',
            'deskripsiFoto' => 'required|string'
        ]);

        $idFoto = $request->input('id');

        $foto = Foto::find($idFoto);
        $foto->judulFoto = $request->input('judulFoto');
        $foto->deskripsiFoto = $request->input('deskripsiFoto');

        if ($request->hasFile('foto')) {
                $path = public_path('storage/foto/') . $foto->jalurFoto;
                if (file_exists($path)) {
                    unlink($path);
                }

            $fotoBaru = $request->file('foto');
            $filename = $fotoBaru->hashName();
            $fotoBaru->store('foto');
            $foto->jalurFoto = $filename;
        }

        $foto->save();

        return redirect()->back()->with('success', 'Data berhasil diperbarui.');



    }

    public function editAlbum( Request $request){
        $request->validate([
            'namaAlbum' => 'required|max:255',
            'deskripsi' => 'required|string'
        ]);

        $idAlbum = $request->input('id');

        $album = Album::find($idAlbum);
        $album->namaAlbum = $request->input('namaAlbum');
        $album->deskripsi = $request->input('deskripsi');

        $album->save();

        return redirect()->back()->with('success', 'Data berhasil diperbarui.');
    }

}
