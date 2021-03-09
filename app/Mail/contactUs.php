<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class contactUs extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public $data;

    public function __construct($data)
    {
        $this->data = $data;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        //dd($this->data);        
        $receiver = 'dev.telocure@gmail.com';
        $sender = $this->data->sender;
        $subject = 'Contact Request';
        $name = $this->data->name;

        return $this->view('mails.contactus')
                    //->from($sender, $this->data->name)
                    ->from("mailer@telocuretest.com", $name)
                    // ->cc($address, $name)
                    // ->bcc($address, $name)
                    //->to($receiver, $name) //28-01-21 ony one receiver will be and added in mail facade's to method earlier 
                    ->subject($subject)
                    ->with([ 'data' => $this->data]);
        
                    /* from OtpEmail mailable class 
                     * return $this->from('dev.telocure@gmail.com')
                    ->view('mails.otp')
                    ->text('mails.otp_plain')
                    ->with(
                      [
                            'testVarOne' => '1',
                            'testVarTwo' => '2',
                      ]);
                     */
    }
}
