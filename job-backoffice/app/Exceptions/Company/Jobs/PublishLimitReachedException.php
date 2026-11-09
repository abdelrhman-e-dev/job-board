<?php

namespace App\Exceptions\Company\Jobs;

use Exception;

class PublishLimitReachedException extends JobActionException
{
  public function __construct(string $message = 'You have reached the maximum number of jobs you can publish. Please upgrade your plan to publish more jobs.')
  {
    parent::__construct($message);
  }
}
