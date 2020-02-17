<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class RejectEmail extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */

    public $message;
    public $url;


    public function __construct( $url, $message)
    {
        //
        $this->url = $url;
        $this->message = $message;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $data = array();
        $data[0] = $this->url;
        $data[1] =$this->message;
        return $this->from('Sumed@Info.com','Sumed')->view('supplier.emails.rejection',compact('data'));
    }
}
