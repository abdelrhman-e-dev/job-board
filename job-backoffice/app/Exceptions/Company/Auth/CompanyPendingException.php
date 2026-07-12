<?php

namespace App\Exceptions\Company\Auth;

use Exception;

class CompanyPendingException extends Exception
{
  public function __construct()
  {
    parent::__construct('Your company is pending, please contact support');
  }
}
