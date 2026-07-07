<?php

namespace App\Exceptions\Company;

use Exception;

class ReassignToMember extends Exception
{
  public array $contextData;

  public function __construct(string $message, array $contextData = [], int $code = 0, \Throwable $previous = null)
  {
    parent::__construct($message, $code, $previous);
    $this->contextData = $contextData;
  }
  public function context(): array
  {
    return [
      'extra_details' => $this->contextData,
    ];
  }
}
