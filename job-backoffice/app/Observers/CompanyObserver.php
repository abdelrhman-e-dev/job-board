<?php

namespace App\Observers;

use App\Models\Company;
use App\Services\Contracts\EmailServiceInterface;

class CompanyObserver
{

  /**
   * Constructor with dependency injection
   *
   * @param EmailServiceInterface $emailService
   */
  public function __construct(private EmailServiceInterface $emailService)
  {
  }
  /**
   * Handle the Company "created" event.
   */
  public function created(Company $company): void
  {
    $this->emailService->sendWelcomeEmail($company);
  }

  /**
   * Handle the Company "updated" event.
   */
  public function updated(Company $company): void
  {
    //
  }

  /**
   * Handle the Company "deleted" event.
   */
  public function deleted(Company $company): void
  {
    //
  }

  /**
   * Handle the Company "restored" event.
   */
  public function restored(Company $company): void
  {
    //
  }

  /**
   * Handle the Company "force deleted" event.
   */
  public function forceDeleted(Company $company): void
  {
    //
  }
}
