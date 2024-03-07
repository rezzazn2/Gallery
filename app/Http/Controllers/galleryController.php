<?php

namespace App\Http\Controllers;

use App\Models\Foto;
use App\Models\Album;
use App\Models\LikeFoto;
use App\Models\Restore;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class galleryController extends Controller
{
    public $data;

    // constructor untuk mendapatkan keseluruhan data
    public function __construct(request $request)
    {

        $this->data = [
            'judul' => $request->path(),
            'fotos' => Foto::where('status', 'muncul')->inRandomOrder()->get(),
            'liked' => Foto::whereHas('likes', function ($query) {
                $query->where('user_id', Auth::id());
            })->get(),
            'albums' => Album::inRandomOrder()->get(),
        ];

    }

    public function guest(){
        $data = $this->data;
        $data["search"] = false ;
        if (Auth::check()) {
            $data["userlogin"] = User::find(Auth::id());
        } else {
            $data["userlogin"] = false;
        }
        return view('gallery.guest', $data);
    }

    // mengarahkan ke ke beranda
    public function index(){
        $data = $this->data;
        $data["search"] = false ;
        $data["userlogin"] = User::find(Auth::id());

        return view('gallery.beranda', $data);
    }

    // mengarahkan ke ke halaman buat
    public function hlmBuat(){
        $data = $this->data;
        $data["search"] = true ;
        $data["userlogin"] = User::find(Auth::id());
        $data["albums"] = Album::where('userId', Auth::id())->get();



        return view('gallery.buat', $data);
    }

    // mengarahkan ke halaman profil
    public function hlmProfil(){
        $data = $this->data;
        $data["fotos"] = Foto::where('userId', Auth::id())->where('status', 'muncul')->latest()->get();
        $data["jmlFoto"] = Foto::where('userId', Auth::id())->where('status', 'muncul')->count();
        $data["jmlAlbum"] = Album::where('userId', Auth::id())->count();
        $data["jmlLike"] = Foto::where('userId', Auth::id())
    ->where('status', 'muncul')
    ->with('likes')
    ->get()
    ->pluck('likes')
    ->flatten()
    ->count();

        $data["dataUser"] = User::where('id', Auth::id())->get()->first();
        $data["isAdmin"] = $data["dataUser"]->role;
        $data["search"] = false;
        $data["userlogin"] = User::find(Auth::id());
        $data["albums"] = Album::where('userId', Auth::id())->get();


         return view('gallery.profil', $data);
    }

    // mengarahkan ke halaman bookmark & Album
    public function hlmBookMark(){
        $data = $this->data;
        $data["search"] = true ;
        $data["userlogin"] = User::find(Auth::id());


        $data["albums"] = Album::where('userId', Auth::id())->get();
        return view('gallery.bookmark', $data);
    }

    public function hlmRestore(Request $request){
        $data = $this->data;
        $data["userlogin"] = User::find(Auth::id());
        $data["search"] = true ;
        $data["fotoRestore"] = Foto::where('userId', Auth::id())->where('status', 'terhapus')->latest()->get();



        return view('gallery.restore', $data);
    }



    // fungsi untuk mengupload dan mengecek foto dengan validasi
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

        if($request->input('selectedAlbum')){
            $selectedAlbum = $request->input('selectedAlbum');
            $idFoto = $foto->id;
            foreach($selectedAlbum as $idalbum){
                $album = Album::find($idalbum);
                $album->fotos()->attach($idFoto);
            }
        }


        session()->flash('success', 'foto berhasil disimpan.');
        return redirect('/profil');
    }

    //
    public function buatAlbum(){
        $data = $this->data;
        return view('gallery.buatAlbum', $data);
    }

    // fungsi untuk membuat album
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
        session()->flash('success', 'Data berhasil disimpan.');
        return redirect()->back();
    }


}
