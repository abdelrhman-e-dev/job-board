<?php

namespace App\Services\Contracts;

use App\Models\Company;

interface EmailServiceInterface
{
  public function sendWelcomeEmail(Company $company);
}