<?php
namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class ContactRequestMail extends Mailable
{
    use Queueable, SerializesModels;

    public $contactDetails;

    public function __construct($contactDetails)
    {
        $this->contactDetails = $contactDetails;
    }

    public function build()
    {
        return $this->subject("Contact request from " . $this->contactDetails['firstname'] . " " . $this->contactDetails['lastname'])
                    ->view('emails.contact_request');
    }
}
