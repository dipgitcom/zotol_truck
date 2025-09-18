<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class PasswordOtpMail extends Mailable
{
    use Queueable, SerializesModels;

    public $user;
       
    public function __construct($user)
    {
        $this->user = $user;
       
    }

    public function build(){
    return $this->subject('Forget Password Mail')
                    ->view('backend.auth.emails.password-otp',with(['user'=>$this->user]));
   }

}

