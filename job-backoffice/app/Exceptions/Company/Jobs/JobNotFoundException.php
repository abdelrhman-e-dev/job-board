<?php

namespace App\Exceptions\Company\Jobs;


class JobNotFoundException extends JobActionException
{
  public function __construct(string $message = 'Job not found.')
  {
    parent::__construct($message);
  }
}
