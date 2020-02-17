<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class ApprovalEmail extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */

    public $activity=[];
    public $url;
    public $files=[];
    public $message;


    public function __construct( $url, $activity, $message, $files)
    {
        //
        $this->url = $url;
        $this->activity = $activity;
        $this->files = $files;
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
        $data['message'] = $this->message;
        $data['activities'] = $this->activity;
        $data['files'] = $this->files;
        return $this->from('Sumed@Info.com','Sumed')->view('supplier.emails.approve',compact('data'));
    }
}
