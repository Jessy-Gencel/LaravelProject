<?php
namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class ContactResponseMail extends Mailable
{
    use Queueable, SerializesModels;

    public $response;
    public $subject;
    public $name;

    /**
     * Create a new message instance.
     *
     * @param array $responseDetails
     */
    public function __construct($response,$subject,$name)
    {
        $this->response = $response;
        $this->subject = $subject;
        $this->name = $name;
    }

    /**
     * Build the message.
     */
    public function build()
    {
        return $this->subject($this->subject) // Optional subject
                    ->view('emails.contact_response'); // Separate template

    }
}
