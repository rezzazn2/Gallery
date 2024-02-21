<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\RedirectResponse;


class authController extends Controller
{
    public function register(Request $request){

        // dd($request);

        $validatedData = $request->validate([
            'nama' => 'required|max:255',
            'username' =>'required|max:255|unique:users,username',
            'alamat' =>'required|max:255',
            'email' =>'required|email:dns|unique:users',
            'password' => 'required|min:8'
        ]);

        // dd($validatedData);


        $validatedData['password'] = Hash::make($validatedData['password']);

        User::create($validatedData);

        return redirect('/login')->with('success', 'Registratsi berhasil dilakukan');

    }

    public function login(Request $request): RedirectResponse
    {

        // dd($request->session);

        $validatedData = $request->validate([
            'username' =>'required|max:255',
            'password' => 'required|min:8'
        ]);

        if (Auth::guard('web')->attempt($validatedData)) {
            $request->session()->regenerate();
            return redirect('/beranda');
        }

        return redirect('/login')->with('gagal', 'username atau password salah salah');


    }

    public function logout(Request $request): RedirectResponse
    {
        Auth::logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/login');
    }
}


