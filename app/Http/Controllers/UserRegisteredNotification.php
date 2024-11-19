<?php
namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class UserRegisteredNotification extends Mailable
{
    use Queueable, SerializesModels;

    public $user;

    public function __construct($user)
    {
        $this->user = $user;
    }

    public function build()
    {
        return $this->subject('Selamat, Pendaftaran Berhasil!')
            ->view('emails.user-registered')
            ->with([
                'name' => $this->user->name,
                'email' => $this->user->email,
                'registeredAt' => $this->user->created_at,
            ]);
    }
}
