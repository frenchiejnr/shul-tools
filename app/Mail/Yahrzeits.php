<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Address;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;
use App\Models\Setting;
use Illuminate\Support\Facades\Auth;

class Yahrzeits extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     */
    public function __construct(public $members) {}

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        $email =     Setting::where('key', 'yahrzeit_email_address')
            ->where('tenant_id', Auth::user()->tenant_id)
            ->value('value') ?? 'shul-tools@gmail.com';

        return new Envelope(
            from: new Address(
                $email,
                'Binyomin Freedman'
            ),
            subject: 'This weeks Yahrzeits',
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            view: 'mail.yahrzeits',
        );
    }

    /**
     * Get the attachments for the message.
     *
     * @return array<int, \Illuminate\Mail\Mailables\Attachment>
     */
    public function attachments(): array
    {
        return [];
    }
}
