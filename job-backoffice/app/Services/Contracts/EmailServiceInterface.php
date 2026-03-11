<?php

namespace App\Services\Contracts;

use App\Models\Company;

interface EmailServiceInterface
{
  public function sendWelcomeEmail(Company $company);
  public function sendVerificationEmail(Company $company);
  public function sendCompanySuspensionEmail(Company $company);
  public function sendCompanyUnsuspensionEmail(Company $company);
}