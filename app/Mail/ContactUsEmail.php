<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class ContactUsEmail extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */

    public $url;
    public $subject;
    public $email;
    public $message;


    public function __construct($url, $subject, $email, $message)
    {
        //
        $this->url = $url;
        $this->subject = $subject;
        $this->email = $email;
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
        $data[1] = $this->subject;
        $data[2] = $this->email;
        $data[3] = $this->message;
        return $this->from('Sumed@Info.com','Sumed')->view('supplier.emails.contactus',compact('data'));
    }
}
