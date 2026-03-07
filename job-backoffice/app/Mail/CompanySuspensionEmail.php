<?php
namespace App\Mail;

use App\Models\Company;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;
use Illuminate\Mail\Mailables\Address;

class CompanySuspensionEmail extends Mailable
{
  use Queueable, SerializesModels;

  public function __construct(private Company $company)
  {
    // Set queue to default queue
    $this->onQueue('default');
  }
  public function envelope(): Envelope
  {
    return new Envelope(
      from: new Address(
        config('mail.from.address'),
        config('mail.from.name')
      ),

      subject: 'Company Suspension Notice',

    );
  }
  public function content(): Content
  {
    //NOTE Specifies the view and passes data
    return new Content(
      view: 'emails.companySuspensionSuccessfully',
      with: [
        'company' => $this->company,
        'appName' => config('app.name')
      ],
    );
  }
}