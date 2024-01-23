<?php

namespace App\Http\Controllers;

use App\Models\Foto;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;


class galleryController extends Controller
{
    public $data;

    public function __construct(request $request)
    {
        // Mendapatkan rute dari URL dan mengisi nilai 'judul'
        $this->data = [
            'judul' => $request->path(),
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
            'foto' => 'required|image|mimes:jpeg,png,jpg,gif|max:4096',
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
    }
}
