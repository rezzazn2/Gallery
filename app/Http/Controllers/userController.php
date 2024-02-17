<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class userController extends Controller
{
    public function editUser(Request $request)
    {
        // Validasi data jika diperlukan
        $request->validate([
            'fotoProfil' => 'image|mimes:jpeg,png,jpg,gif|max:2048', // Contoh validasi untuk gambar
            'username' => 'required',
            'namaLengkap' => 'required',
            'alamat' => 'required',
            'email' => 'required|email'
        ]);



        // Proses pengolahan data
        $user = User::find(Auth::id());
        $user->username = $request->input('username');
        $user->nama = $request->input('namaLengkap');
        $user->alamat = $request->input('alamat');
        $user->email = $request->input('email');

        if($request->input('passwordLama') && $request->input('passwordBaru')){
            $request->validate([
                'passwordLama' => 'required_with:passwordBaru',
                'passwordBaru' => 'required_with:passwordLama|min:8'
            ]);
            if (Hash::check($request->input('passwordLama'), $user->password)) {
                // Jika password lama cocok, lanjutkan dengan validasi password baru
                $user->password = bcrypt($request->input('passwordBaru'));
            } else {
                // Jika password lama tidak cocok, berikan pesan kesalahan
                return redirect()->back()->with('error', 'Password lama tidak cocok.');
            }
        }

        // Proses upload foto profil jika ada
        if ($request->hasFile('fotoProfil')) {
            if ($user->fotoProfil != 'default.jpg') {
                $path = public_path('storage/foto/') . $user->fotoProfil;
                if (file_exists($path)) {
                    unlink($path);
                }
            }
            $fotoProfil = $request->file('fotoProfil');
            $filename = $fotoProfil->hashName();
            $fotoProfil->store('foto');
            $user->fotoProfil = $filename;
        }

        $user->save();

        // Redirect atau berikan respons sesuai kebutuhan
        return redirect()->back()->with('success', 'Data berhasil diperbarui.');
    }
}
