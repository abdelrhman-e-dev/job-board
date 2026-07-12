<?php

namespace App\Exceptions\Company\Auth;

use Exception;

class CompanySuspendedException extends Exception
{
  public function __construct()
  {
    parent::__construct('Your company has been suspended, please contact support');
  }
}
