<?php

namespace App\DTO\Company;

final class UserDTO
{
  /**
   * Create a new class instance.
   */
  public function __construct(
    public string $first_name,
    public string $last_name,
    public string $email,
    public string $password,
    public ?int $roleId = null,
  ) {
    //
  }
}
