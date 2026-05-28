<?php

namespace App\Mail\Company;

use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Address;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class PasswordUpdated extends Mailable
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
      subject: 'Password Updated',
    );
  }

  /**
   * Get the message content definition.
   */
  public function content(): Content
  {
    return new Content(
      view: 'emails.company.passwordUpdated',
      with: [
        'fullName' => $this->user->first_name . ' ' . $this->user->last_name,
        'email' => $this->user->email,
        'appName' => config('app.name'),
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
