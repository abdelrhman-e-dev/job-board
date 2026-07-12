<?php

namespace App\Exceptions\Company\Auth;

use Exception;

class UnauthorizedRoleException extends Exception
{
  public function __construct()
  {
    parent::__construct('You are not authorized to access this area');
  }
}
