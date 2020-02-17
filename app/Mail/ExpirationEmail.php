<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class ExpirationEmail extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */

    public $document;
    public $url;


    public function __construct( $url, $document)
    {
        //
        $this->url = $url;
        $this->document = $document;
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
        $data[1] = $this->document;
        return $this->from('Sumed@Info.com','Sumed')->view('supplier.emails.expiration',compact('data'));
    }
}
