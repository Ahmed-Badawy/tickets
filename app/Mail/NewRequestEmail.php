<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class NewRequestEmail extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */

    public $supplierName;
    public $url;


    public function __construct( $url, $supplierName)
    {
        //
        $this->url = $url;
        $this->supplierName = $supplierName;
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
        $data[1] = 'The '.$this->supplierName.' had submitted new request, kindly check new request section.';
        return $this->from('Sumed@Info.com','Sumed')->view('supplier.emails.newrequest',compact('data'));
    }
}
