<?php

namespace App\Exceptions\Company;

use Exception;

class EmailAlreadyExistsException extends Exception
{
  public function __construct()
  {
    parent::__construct('A user with this email already exists.');
  }
}