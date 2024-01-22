<?php

namespace App\Http\Controllers;

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
}
