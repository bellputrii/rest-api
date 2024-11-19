<?php

namespace App\Http\Controllers;

use App\Jobs\SendDaftarJob;
use Illuminate\Support\Facades\Mail;
use App\Mail\SendDaftarEmail;
use Illuminate\Http\Request;

class SendDaftarController extends Controller
{
    public function index()
    {
        return view('emails.user-register');
    }
    public function store(Request $request){
        $data_new = $request->all();
        dispatch(new SendDaftarJob($data_new));
        return redirect()->route('user-register')->with('success', 'Email berhasil dikirim');
    }
}
