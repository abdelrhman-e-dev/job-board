<?php

namespace App\Exceptions\Company\Jobs;

use Exception;

class ActionNotAvailableException extends JobActionException
{
  public function __construct(string $message = 'This action is not allowed for this job.')
  {
    parent::__construct($message);
  }
}
