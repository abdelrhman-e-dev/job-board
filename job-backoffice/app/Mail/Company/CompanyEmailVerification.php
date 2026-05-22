<?php

namespace App\Mail\Company;

use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Address;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\URL;

class CompanyEmailVerification extends Mailable
{
  use Queueable, SerializesModels;

  /**
   * Create a new message instance.
   */
  public function __construct(private User $user)
  {
    $this->onQueue('default');
  }

  /**
   * Get the message envelope.
   */
  public function envelope(): Envelope
  {
    return new Envelope(
      from: new Address(env("MAIL_FROM_ADDRESS"), env("MAIL_FROM_NAME")),
      to: [
        new Address($this->user->email, $this->user->first_name . ' ' . $this->user->last_name)
      ],
      subject: 'Verify Your Email Address',
    );
  }

  /**
   * Get the message content definition.
   */
  public function content(): Content
  {

    $verificatonUrl = URL::temporarySignedRoute('company.email.verification', now()->addHours(24), [
      'id' => $this->user->user_id,
      'hash' => sha1($this->user->email),
    ]);

    return new Content(
      view: 'emails.company.companyVerificationEmail',
      with: [
        'firstName' => $this->user->first_name . ' ' . $this->user->last_name,
        'appName' => config('app.name'),
        'verificationUrl' => $verificatonUrl,
        'expiryHours' => 24,
      ]
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
