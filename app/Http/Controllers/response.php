<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class response extends Controller
{
    public function addSuccessMessage()
    {
        // Tambahkan pesan sukses ke dalam session
        Session::flash('success', 'Data user berhasil diperbarui.');

        // Kirim respon sukses
        return response()->json(['success' => true]);
    }
}
