<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class signupEmail extends Mailable
{
    use Queueable, SerializesModels;

    public  $title;
    public $code;
  

    public function __construct($title,$code)
    {
        $this->title = $title;
         $this->code=$code;

    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $co=$this->code;
        return $this->subject('المصادقة')->view('mailsignup',compact('co'))->with('tit',$this->title);
    }
}
