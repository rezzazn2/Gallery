<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Foto;

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

}
