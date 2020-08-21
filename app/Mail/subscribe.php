<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class subscribe extends Mailable
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
        $sender = $this->data->receiver;

        //dd($sender);
      
        //$address = 'support@telocure.com';
        $to = 'dev.telocure@gmail.com';
        $subject = 'Subscribe telocure';
        $name = 'TeloCure';

        return $this->view('mails.subscribe')
                    ->from($sender)
                    // ->cc($address, $name)
                    // ->bcc($address, $name)
                    ->to('dev.telocure@gmail.com', $name)
                    ->subject($subject)
                    ->with([ 'data' => $this->data]);
    }
}
