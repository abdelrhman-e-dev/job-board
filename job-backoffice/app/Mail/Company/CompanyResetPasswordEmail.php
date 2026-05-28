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

class CompanyResetPasswordEmail extends Mailable
{
  use Queueable, SerializesModels;

  /**
   * Create a new message instance.
   */
  public function __construct(private User $user, private string $token)
  {
    //
  }

  /**
   * Get the message envelope.
   */
  public function envelope(): Envelope
  {
    return new Envelope(
      subject: 'Reset Password Notification',
      to: [
        new Address($this->user->email, $this->user->name)
      ],
    );
  }

  /**
   * Get the message content definition.
   */
  public function content(): Content
  {
    $resetUrl = route('company.reset-password', [
      'token' => $this->token,
      'email' => $this->user->email,
    ], false);

    return new Content(
      view: 'emails.company.companyResetPasswordEmail',
      with: [
        'firstName' => $this->user->first_name,
        'lastName' => $this->user->last_name,
        'resetUrl' => $resetUrl,
        'appName' => config('app.name'),
        'expiryMinutes' => config('auth.passwords.' . config('auth.defaults.passwords') . '.expire', 60),
      ],
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
