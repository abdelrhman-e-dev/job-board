<?php

namespace App\Services\Company;

use App\Repositories\Company\DashboardRepository;

class DashboardService
{
  /**
   * Create a new class instance.
   */
  public function __construct(private DashboardRepository $repository)
  {
  }

  // get stats
  public function getStats()
  {
    return [
      'total_jobs' => $this->repository->totalJobs(),
      'total_applications' => $this->repository->totalApplications(),
      'active_jobs' => $this->repository->activeJobs(),
      'new_applications_today' => $this->repository->newApplicationsToday(),
    ];
  }

  // get recent applications
  public function getRecentApplications(int $limit = 5)
  {
    return $this->repository->recentApplications($limit);
  }

  // get recent jobs
  public function getRecentJobs(int $limit = 5)
  {
    return $this->repository->recentJobs($limit);
  }

  // get missing data
  public function getMissingData()
  {
    $missing = $this->repository->missingData();
    return [
      'missing' => $missing,
      'percentage' => round((14 - $missing->count()) / 14 * 100),
    ];
  }
}
