<?php

namespace App\Http\Controllers;

use App\Models\Foto;
use App\Models\Album;
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

        // Lakukan query pencarian berdasarkan model Foto Anda
        $data = $this->data;
        $data['fotos'] = Foto::where('judulFoto', 'like', '%' . $keyword . '%')->get();

        return view('gallery.search', $data);
    }

    public function modalById(Request $request)
    {
        $dataId = $request->input('dataId');
        $data = $this->data;

        if($dataId !== null){
            $data["tersimpan"] = true;
            $data["albumId"] = $dataId;
        }

        // Lakukan query pencarian berdasarkan model Foto Anda
        $data['albums'] = Album::where('userId', Auth::id())->get();


        return view('gallery.modal-simpan', $data);
    }

    public function storeFotoAlbum(Request $request)
    {
        $idFoto = (int)$request->input('idFoto');
        $idAlbum = (int)$request->input('idAlbum');

        $foto = Foto::find($idFoto);

        if ($foto) {
            // Melakukan update kolom album_id
            $foto->update(['albumId' => $idAlbum]);

            return response()->json(['message' => 'Data foto berhasil diupdate']);
        } else {
            return response()->json(['message' => 'Foto tidak ditemukan'], 404);
        }

    }

    public function previewImg(Request $request)
    {
        $data = $this->data;
        $idFoto = $request->input('idFoto');
        $data['modalFoto'] = Foto::where('id', $idFoto)->get();

        return  view('gallery.preview-img', $data);
    }

}
