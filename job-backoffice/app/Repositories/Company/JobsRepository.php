<?php

namespace App\Repositories\Company;

use App\Models\JobVacancy;
use Illuminate\Pagination\LengthAwarePaginator;
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
  public function totalJobsCount(?string $hiringManagerID = null): int
  {
    return JobVacancy::query()
      ->when($hiringManagerID, fn($q) => $q->where('posted_by', $hiringManagerID))
      ->where('company_id', $this->company_id)->count();
  }
  // Active jobs
  public function activeJobsCount(?string $hiringManagerID = null): int
  {
    return JobVacancy::query()
      ->when($hiringManagerID, fn($q) => $q->where('posted_by', $hiringManagerID))
      ->where('company_id', $this->company_id)
      ->active()
      ->count();
  }
  // Draft jobs
  public function draftJobsCount(?string $hiringManagerID = null): int
  {
    return JobVacancy::query()
      ->when($hiringManagerID, fn($q) => $q->where('posted_by', $hiringManagerID))
      ->where('company_id', $this->company_id)
      ->draft()
      ->count();
  }
  // Closed jobs
  public function closedJobsCount(?string $hiringManagerID = null): int
  {
    return JobVacancy::query()
      ->when($hiringManagerID, fn($q) => $q->where('posted_by', $hiringManagerID))
      ->where('company_id', $this->company_id)
      ->closed()
      ->count();
  }

  // get all jobs 
  public function getAllJobs($perPage = 10, ?string $hiringManagerID = null, ?string $search = null, ?string $status = null): LengthAwarePaginator
  {
    return JobVacancy::query()
      ->where('company_id', $this->company_id)
      ->when($search, fn($q) => $q->where('title', 'like', "%{$search}%"))
      ->when($status, fn($q) => $q->where('status', $status))
      ->when($hiringManagerID, fn($q) => $q->where('posted_by', $hiringManagerID))
      ->when(!$hiringManagerID, fn($q) => $q->with('creator:user_id,first_name,last_name,email'))
      ->latest()
      ->paginate($perPage);
  }
  // get jobs status 
  public function getStatus()
  {
    return JobVacancy::STATUS_OPTIONS_FOR_ADMIN;
  }
}
