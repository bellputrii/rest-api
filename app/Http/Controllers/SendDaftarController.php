<?php

namespace App\Http\Controllers;

use App\Jobs\SendDaftarJob;
use Illuminate\Http\Request;

class SendDaftarController extends Controller
{
    public function index()
    {
        // Menampilkan halaman form pendaftaran
        return view('emails.user-register-form');
    }

    public function store(Request $request)
    {
        // Validasi input
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'email_new' => 'required|email',
            'subject1' => 'required|string|max:255',
        ]);

        // Dispatch job untuk mengirim email
        dispatch(new SendDaftarJob($validatedData));

        return redirect()->route('user-register')->with('success', 'Email berhasil dikirim');
    }
}
