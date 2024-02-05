<?php

namespace App\Http\Controllers;

use App\Models\Foto;
use App\Models\Album;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;


class galleryController extends Controller
{
    public $data;

    public function __construct(request $request)
    {
        // Mendapatkan rute dari URL dan mengisi nilai 'judul'
        $this->data = [
            'judul' => $request->path(),
            'fotos' => Foto::all(),
            'albums' => Album::where('userId', Auth::id())->get()
        ];

    }

    public function index(){
        $data = $this->data;
        return view('gallery.beranda', $data);
    }

    public function hlmBuat(){
        $data = $this->data;
        return view('gallery.buat', $data);
    }


    public function store(request $request){


        $request->validate([
            'foto' => 'required|image|mimes:jpeg,png,jpg,gif|max:10240',
            'judulFoto' => 'required|max:255',
            'deskripsiFoto' => 'required|string'
        ]);

        $foto = new Foto();
        $foto->judulFoto = $request->input('judulFoto');
        $foto->deskripsiFoto = $request->input('deskripsiFoto');


        if ($request->hasFile('foto')) {
            $gambar = $request->file('foto');
            $namafoto = $gambar->hashName();
            $gambar->store('foto');
            $foto->jalurFoto = $namafoto;
        }

        $foto->userId = auth()->id();
        $foto->save();

        return redirect('/beranda');
    }

    public function buatAlbum(){
        $data = $this->data;
        return view('gallery.buatAlbum', $data);
    }

    public function storeAlbum(Request $request){

        $request->validate([
            'namaAlbum' => 'required|string',
            'deskripsi' => 'required|string',
        ]);

        $userId = Auth::id();

        // Membuat objek Album baru
        $album = new Album();

        // Mengisi atribut-atribut Album dengan data dari formulir
        $album->namaAlbum = $request->input('namaAlbum');
        $album->deskripsi = $request->input('deskripsi');
        $album->userId = $userId;

        // Menyimpan objek Album ke dalam database
        $album->save();

        // Redirect atau berikan respons sesuai kebutuhan aplikasi Anda
        return redirect()->route('beranda');
    }
}
