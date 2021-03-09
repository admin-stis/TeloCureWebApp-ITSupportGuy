<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class sendLink extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public $otp;

    public function __construct($otp)
    {
        $this->otp = $otp;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $address = 'dev.telocure@gmail.com';
        $subject = 'Login Information';
        $name = 'TeloCure';
        //$receiver = $this->otp->name ;
        // echo 'hello ';
        // dd($this->otp);
        
        return $this->view('mails.docLink')
                    ->from($address, $name)
                    // ->cc($address, $name)
                    // ->bcc($address, $name)
                    ->subject($subject)
                    ->with([ 'otp' => $this->otp]);
    }
}
