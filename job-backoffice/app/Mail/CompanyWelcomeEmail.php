<?php

namespace App\Mail;

use App\Models\Company;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Address;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class CompanyWelcomeEmail extends Mailable
{
  use Queueable, SerializesModels;

  /**
   * Create a new message instance.
   */
  public function __construct(private Company $company)
  {
    // Set queue to default queue
    $this->onQueue('default');
  }

  /**
   * Get the message envelope.
   */
  public function envelope(): Envelope
  {
    return new Envelope(
      from: new Address(
        config('mail.from.address'),
        config('mail.from.name')
      ),
      subject: 'Welcome to ' . config('app.name'),
    );
  }

  /**
   * Get the message content definition.
   */
  public function content(): Content
  {
    //NOTE Specifies the view and passes data
    return new Content(
      view: 'emails.companyWelcome',
      with: [
        'company' => $this->company,
        'appName' => config('app.name')
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
