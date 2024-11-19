<?php
namespace App\Http\Controllers;

use App\Mail\UserRegistered;
use App\Mail\UserRegisteredMail;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;

class UserController extends Controller
{
    public function register(Request $request)
    {
        // Validasi input
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|string|min:6',
        ]);

        // Simpan data pengguna ke database
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        // Kirim email kepada pengguna
        Mail::to($user->email)->send(new  UserRegisteredMail($user));

        return redirect()->back()->with('status', 'Pengguna berhasil didaftarkan dan email terkirim.');
    }
}
