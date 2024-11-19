<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Mail;

class SendDaftarJob implements ShouldQueue
{
    use Queueable, InteractsWithQueue, SerializesModels;

    protected $data;

    public function __construct($data)
    {
        $this->data = $data;
    }

    public function handle()
    {
        Mail::send('emails.user-register', ['data' => $this->data], function ($message) {
            $message->to($this->data['email_new']) // Pastikan key array benar
                    ->subject('Pendaftaran Berhasil');
        });
    }
}

