<?php

namespace App\Http\Controllers;

use App\Models\User;
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
    public function checkAdmin(){
        $data = $this->data;
        $user = User::where('id', Auth::id())->first();
        $data["userlogin"] = User::find(Auth::id());
        $role = $user->role;
        $data["search"] = true;
        $data["users"] = User::paginate(4);
        if($role == 'admin'){
            return view('gallery.admin', $data);
        }

        return redirect('/beranda');

    }
}
