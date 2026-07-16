<?php

namespace App\DTO\Company;

class CompanyDTO
{
  /**
   * Create a new class instance.
   */
  public function __construct(
    public string $company_name,
    public string $company_slug,
    public string $industry,
    public string $size,
    public string $city,
    public string $country,
    public string $status,
    public ?int $owner_id = null,
  ) {
    //
  }
}
