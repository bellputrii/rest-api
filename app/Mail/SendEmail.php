<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class SendEmail extends Mailable
{
    use Queueable, SerializesModels;

    public $data;
    public $user;


    // public function __construct(array $data)
    // {
    //     $this->data = $data;
    // }

    public function __construct($user)
    {
        $this->user = $user;
    }

    public function build()
    {
        // return $this->subject($this->data['subject'])->view('emails.send_email');

        return $this->subject('Selamat, Pendaftaran Berhasil!')
                    ->view('emails.user-register');
    }
}