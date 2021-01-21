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
    public $customer_details;
  

    public function __construct($title,$customer_details)
    {
        $this->title = $title;
        $this->customer_details= $customer_details;

    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->subject($this->title)->view('mailsignup');
    }
}
