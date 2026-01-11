<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class TwoFactorCodeMail extends Mailable
{
    use Queueable, SerializesModels;

    public User $user;

    public function __construct(User $user)
    {
        $this->user = $user;
    }

    public function build()
    {
        return $this->subject('Your Two-Factor Authentication Code')
            ->view('emails.two_factor_code')
            ->with([
                'twoFactorCode' => $this->user->two_factor_code,
            ]);
    }
}
