<?php

namespace App\Mail\Company;

use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;
use Illuminate\Mail\Mailables\Address;
use URL;

class InvitationEmail extends Mailable
{
  use Queueable, SerializesModels;

  /**
   * Create a new message instance.
   */
  public function __construct(private User $user, private string $token)
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
      subject: 'You\'ve been invited to join ' . $this->user->company->name,
    );
  }

  /** 
   * Get the message content definition.
   */
  public function content(): Content
  {

    $invitationUrl = route('company.member.invitation', [
      'id' => $this->user->user_id,
      'token' => $this->user->invitation_token,
    ]);

    return new Content(
      view: 'emails.company.InvitationEmail',
      with: [
        'companyName' => $this->user->company->name,
        'firstName' => $this->user->first_name,
        'inviterName' => $this->user->company->owner->first_name . ' ' . $this->user->company->owner->last_name,
        'appName' => config('app.name'),
        'invitationUrl' => $invitationUrl,
        'expiresAt' => now()->addHours(48),
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
