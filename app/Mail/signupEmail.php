<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class signupEmail extends Mailable
{
    use Queueable, SerializesModels;

  
    public function __construct($data)
    {
        $this->email_data=$data;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->from(env('MAIL_USERNAME'),'coder aweso.me')->subject('welcome to coderawseo.me')->view('mailsignup',['email_data'=>$this->email_data]);
    }
}
