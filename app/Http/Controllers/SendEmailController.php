<?php

namespace App\Http\Controllers;

use App\Jobs\SendMailJob;
use Illuminate\Support\Facades\Mail;
use App\Mail\SendEmail;
use Illuminate\Http\Request;

class SendEmailController extends Controller
{
    public function index()
    {
        return view('emails.kirim-email');
        // $content = [
        //     'name' => 'Ini Nama Pengirim',
        //     'subject' => 'Ini subject email',
        //     'body' => 'Ini adalah isi email yang dikirim dari Laravel 10',
        // ];

        // Mail::to('beldaputri5@gmail.com')->send(new SendEmail($content));

        // return response()->json(['message' => 'Email berhasil dikirim.']);
    }
    public function store(Request $request){
        $data = $request->all();
        dispatch(new SendMailJob($data));
        return redirect()->route('kirim-email')->with('success', 'Email berhasil dikirim');
    }
}
