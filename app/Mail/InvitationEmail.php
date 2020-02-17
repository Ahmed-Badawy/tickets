<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class InvitationEmail extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */

    public $url;
    public $username;
    public $password;


    public function __construct($username, $url, $password)
    {
        //
        $this->url = $url;
        $this->username = $username;
        $this->password = $password;
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
        $data[1] = $this->url . '/supplier/login';
        $data[2] = $this->username;
        $data[3] = $this->password;
        return $this->from('Sumed@Info.com','Sumed')->view('supplier.emails.invitation',compact('data'));
    }
}
