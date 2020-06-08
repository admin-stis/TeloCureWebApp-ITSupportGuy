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
        $receiver = 'support@telocure.com';
        $sender = $this->data->sender;
        $subject = 'User query';
        $name = $this->data->name;

        return $this->view('mails.contactus')
                    ->from($sender, $this->data->name)
                    // ->cc($address, $name)
                    // ->bcc($address, $name)
                    ->to($receiver, $name)
                    ->subject($subject)
                    ->with([ 'data' => $this->data]);
    }
}
