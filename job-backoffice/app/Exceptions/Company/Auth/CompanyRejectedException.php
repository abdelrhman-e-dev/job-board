<?php

namespace App\Exceptions\Company\Auth;

use Exception;

class CompanyRejectedException extends Exception
{
  public function __construct()
  {
    parent::__construct('Your company has been rejected, please contact support');
  }
}
