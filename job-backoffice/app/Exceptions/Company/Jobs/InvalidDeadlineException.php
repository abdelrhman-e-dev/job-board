<?php

namespace App\Exceptions\Company\Jobs;

use Exception;

class InvalidDeadlineException extends Exception
{
  public function __construct(string $message = 'The job deadline is invalid. Please provide a valid future date for the deadline.')
  {
    parent::__construct($message);
  }
}
