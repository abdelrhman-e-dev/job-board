<?php

namespace App\Services;

use App\Mail\CompanyWelcomeEmail;
use App\Models\Company;
use App\Services\Contracts\EmailServiceInterface;
use Illuminate\Support\Facades\Mail;
use Throwable;
use Illuminate\Support\Facades\Log;

class EmailService implements EmailServiceInterface
{
  /**
   * Send welcome email to user
   *
   * @param Company $company
   * @return bool
   */

  public function sendWelcomeEmail(Company $company)
  {
    if ($company->welcome_email_sent) {
      Log::info('Welcome email already sent', [
        'company_id' => $company->company_id,
        'email' => $company->contact_email,
      ]);
      return false;
    }
    try {
      Mail::to($company->contact_email)->queue(new CompanyWelcomeEmail($company));

      Log::info('Welcome email queued', [
        'company_id' => $company->company_id,
        'email' => $company->contact_email,
      ]);

      return true;
    } catch (Throwable $e) {
      $this->logError('Welcome email failed', $company->contact_email, $e);
      return false;
    }
  }


  /**
   * Log email errors for debugging
   *
   * @param string $action
   * @param string $email
   * @param Throwable $error
   * @return void
   */
  private function logError(string $action, string $email, Throwable $error): void
  {
    Log::error($action, [
      'email' => $email,
      'error' => $error->getMessage(),
      'trace' => $error->getTraceAsString(),
    ]);
  }
}