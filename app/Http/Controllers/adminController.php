<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Laporan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class adminController extends Controller
{
    public $data;


    public function __construct(request $request)
    {
        // Mendapatkan rute dari URL dan mengisi nilai 'judul'
        $this->data = [
            'judul' => $request->path()
        ];

    }

    // untuk mengecek ketika url ke admin, mengecek apakah yang mengakses halaman admin atau bukan dan menampilkan tabel data-user
    public function checkAdmin(){
        $data = $this->data;
        $user = User::where('id', Auth::id())->first();
        $data["userlogin"] = User::find(Auth::id());
        $role = $user->role;
        $data["search"] = true;
        $data["users"] = User::paginate(4);
        if($role == 'admin'){
            return view('gallery.admin.admin', $data);
        }

        return redirect('/beranda');

    }

    // untuk mengecek ketika url ke admin, mengecek apakah yang mengakses halaman admin atau bukan dan menampilkan tabel data-laporan
    public function laporan(){
        $data = $this->data;
        $user = User::where('id', Auth::id())->first();
        $data["userlogin"] = User::find(Auth::id());
        $role = $user->role;
        $data["search"] = true;
        $data["laporan"] = Laporan::paginate(4);
        if($role == 'admin'){
            return view('gallery.admin.laporan', $data);
        }

        return redirect('/beranda');

    }
}
