<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class AvailableOpportunitiesEmail extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */

    public $url;
    public $message;
    public $template;
    public $files;


    public function __construct( $url, $message, $template, $files)
    {
        //
        $this->url = $url;
        $this->message = $message;
        $this->template = $template;
        $this->files = $files;
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
        $data[1] = $this->message;
        $data[2] = $this->template;
        $data[3] = $this->files;
        return $this->from('Sumed@Info.com','Sumed')->view('supplier.emails.updatesEmail',compact('data'));
    }
}
