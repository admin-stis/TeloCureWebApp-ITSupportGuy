<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class SendRequest extends Mailable
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
        $address = $this->data->receiver;
        $subject = 'Request for update bank information.';
        $name = 'TeloCure' ;

        return $this->view('mails.sendrequest')
                    ->from($address, $name)
                    ->subject($subject)
                    ->with([ 'data' => $this->data]);
    }
}
