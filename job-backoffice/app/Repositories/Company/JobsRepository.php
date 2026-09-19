<?php

namespace App\Repositories\Company;

use App\Models\JobVacancy;
use Illuminate\Support\Facades\Auth;

class JobsRepository
{
  private $company_id;
  public function __construct()
  {
    $this->company_id = Auth::guard('company')
      ->user()
      ->company_id;
  }
  // total jobs posted
  public function totalJobsCount(): int
  {
    return JobVacancy::where('company_id', $this->company_id)->count();
  }
  // Active jobs
  public function activeJobsCount(): int
  {
    return JobVacancy::where('company_id', $this->company_id)
      ->active()
      ->count();
  }
  // Draft jobs
  public function draftJobsCount(): int
  {
    return JobVacancy::where('company_id', $this->company_id)
      ->draft()
      ->count();
  }
  // Closed jobs
  public function closedJobsCount(): int
  {
    return JobVacancy::where('company_id', $this->company_id)
      ->closed()
      ->count();
  }

}
