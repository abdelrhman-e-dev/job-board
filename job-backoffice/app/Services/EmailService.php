<?php

namespace App\Services;

use App\Mail\CompanySuspensionEmail;
use App\Mail\CompanyUnsuspensionEmail;
use App\Mail\CompanyVerificationEmail;
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
  public function sendVerificationEmail(Company $company)
  {
    try {
      Mail::to($company->contact_email)->queue(new CompanyVerificationEmail($company));

      Log::info('company verification email queued', [
        'company_id' => $company->company_id,
        'email' => $company->contact_email,
      ]);

      return true;
    } catch (Throwable $e) {
      $this->logError('company verification email failed', $company->contact_email, $e);
      return false;
    }
  }

  public function sendCompanySuspensionEmail(Company $company)
  {
    try {
      Mail::to($company->contact_email)->queue(new CompanySuspensionEmail($company));

      Log::info('company suspension email queued', [
        'company_id' => $company->company_id,
        'email' => $company->contact_email,
      ]);

      return true;
    } catch (Throwable $e) {
      $this->logError('company suspension email failed', $company->contact_email, $e);
      return false;
    }
  }
  public function sendCompanyUnsuspensionEmail(Company $company)
  {
    try {
      Mail::to($company->contact_email)->queue(new CompanyUnsuspensionEmail($company));

      Log::info('company unsuspension email queued', [
        'company_id' => $company->company_id,
        'email' => $company->contact_email,
      ]);

      return true;
    } catch (Throwable $e) {
      $this->logError('company unsuspension email failed', $company->contact_email, $e);
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