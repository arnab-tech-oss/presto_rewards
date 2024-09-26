<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;
use Illuminate\Mail\Mailables\Attachment;

class ValidateMail extends Mailable
{
    use Queueable, SerializesModels;
    public $maildata;
    public $ref_code;
    public $subject;
    
    
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($maildata, $ref_code, $subject )
    {
        //
        $this->maildata = $maildata;
        $this->ref_code = $ref_code;
        $this->subject = $subject;
       
    }

    /**
     * Get the message envelope.
     *
     * @return \Illuminate\Mail\Mailables\Envelope
     */
    // public function envelope()
    // {
    //     return new Envelope(
    //         subject: $this->subject . $this->ref_code,
    //     );
    // }

    /**
     * Get the message content definition.
     *
     * @return \Illuminate\Mail\Mailables\Content
     */
    public function content()
    {
        return new Content(
            view: 'admin.validatemail',
        );
    }

    /**
     * Get the attachments for the message.
     *
     * @return array
     */
    // public function attachments()
    // {
    //     $pdfPath = public_path('images/docimage');

    //       return [
    //           Attachment::fromPath(public_path('images/docimage')),
    //        ];
    // }

    public function build()
    {
        $mail = $this->view('admin.validatemail')
            ->subject($this->subject . $this->ref_code);

        if ($this->maildata && isset($this->maildata['file'])) {
            $mail->attach($this->maildata['file']);
        }

        return $mail;
    }
}
