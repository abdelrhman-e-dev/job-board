<?php

namespace App\Exceptions\Company\Auth;

use Exception;

class InactiveUserException extends Exception
{
  public function __construct()
  {
    parent::__construct('Your account has been deactivated, please contact support');
  }
}
