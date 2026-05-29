<?php

namespace App\Repositories\Company;

use App\Models\Application;
use App\Models\Company;
use App\Models\JobVacancy;
use Illuminate\Support\Facades\Auth;

class DashboardRepository
{
  /**
   * Create a new class instance.
   */
  private $company_id;
  public function __construct()
  {
    $this->company_id = Auth::guard('company')
      ->user()
      ->company_id;
  }
  // Total Jobs Posted
  public function totalJobs()
  {
    return JobVacancy::where('company_id', $this->company_id)->count();
  }
  // Active Jobs
  public function activeJobs()
  {
    return JobVacancy::where('company_id', $this->company_id)
      ->where('status', 'active')
      ->count();
  }
  // Total Applications
  public function totalApplications()
  {
    return Application::whereHas('job', function ($q) {
      $q->where('company_id', $this->company_id);
    })->count();
  }
  // New Applications Today
  public function newApplicationsToday(): int
  {
    return Application::whereHas('job', function ($q) {
      $q->where('company_id', $this->company_id);
    })->whereDate('created_at', today())->count();
  }
  // recent applications
  public function recentApplications(int $limit = 5)
  {
    return Application::with(['jobSeeker', 'job'])
      ->whereHas('job', function ($q) {
        $q->where('company_id', $this->company_id);
      })
      ->latest()
      ->limit($limit)
      ->get();
  }

  // missing company data
  public function missingData()
  {
    $fields = [
      'logo',
      'banner',
      'description',
      'industry',
      'specialization',
      'size',
      'founded_year',
      'website',
      'address',
      'city',
      'country',
      'contact_phone',
      'contact_email',
      'social_links',
    ];
    $company = Company::select($fields)->find($this->company_id);
    return collect($fields)->filter(fn($field) => empty($company->$field))->values();
  }
}
