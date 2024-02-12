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

        // Lakukan query pencarian berdasarkan model Foto Anda
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
        $dataId = $request->input('dataId');
        $idFoto = $request->input('idFoto');
        $data = $this->data;
        $data["albumId"] = $dataId;

        // Lakukan query pencarian berdasarkan model Foto Anda
        $data['albums'] = Album::where('userId', Auth::id())->get();
        $data['marked'] = Foto::find($idFoto)->albums()->whereIn('album_id', $data['albums']->pluck('id'))->get();


        $data['idfoto'] = $idFoto;

        return view('gallery.modal-simpan', $data);
    }

    public function storeFotoAlbum(Request $request)
    {
        $idFoto = (int)$request->input('idFoto');
        $idAlbum = (int)$request->input('idAlbum');
        $check = album_foto::where('album_id', $idAlbum)->where('foto_id', $idFoto)->count();
        if($check > 0){
            $album = Album::find($idAlbum);
            $album->fotos()->detach($idFoto);
        }else{
            $album = Album::find($idAlbum);
            $album->fotos()->attach($idFoto);
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

    public function prosesLike(Request $requst){
        $idFoto = $requst->input('idFoto');
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

}
