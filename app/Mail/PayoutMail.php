<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class PayoutMail extends Mailable
{
    use Queueable, SerializesModels;

    public $maildata;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($maildata)
    {
        $this->maildata = $maildata;
       
    }

    /**
     * Get the message envelope.
     *
     * @return \Illuminate\Mail\Mailables\Envelope
     */
    // public function envelope()
    // {
    //     return new Envelope(
    //         subject: 'Payout Mail Send Successful',
    //     );
    // }

    /**
     * Get the message content definition.
     *
     * @return \Illuminate\Mail\Mailables\Content
     */
    // public function content()
    // {
    //     return new Content(
    //         view: 'admin.payoutmail',
    //     );
    // }

    /**
     * Get the attachments for the message.
     *
     * @return array
     */
    // public function attachments()
    // {
    //     return [];
    // }

    public function build()
    {
        $subject = 'Payout Request Process' . $this->maildata['ref_no'] .'- Presto Plast India Rewards App - Ref No:' . $this->maildata['reff_no'];

        $message = $this->view('admin.payoutmail')
                        ->subject($subject);

        // if (isset($this->maildata['image']) && $this->maildata['image'] instanceof UploadedFile) {
        //     $message->attach($this->maildata['image']->getRealPath(), [
        //         'as' => $this->maildata['image']->getClientOriginalName(),
        //         'mime' => $this->maildata['image']->getClientMimeType(),
        //     ]);
        // }

        return $message;
    }
}
