<?php

namespace App\Exceptions\Company\Auth;

use Exception;

class RegistrationFailed extends Exception
{
  public function __construct($message = 'Registration failed , Try Later', $code = 0, Exception $previous = null)
  {
    parent::__construct($message, $code, $previous);
  }
}
