<?php

namespace App\Exceptions\Company;

use Exception;

class TeamLimitReachedException extends Exception
{
  public function __construct()
  {
    parent::__construct('You have reached the maximum number of hiring managers.');
  }
}
