<?php

namespace App\Services\Company;

use App\Repositories\Company\JobsRepository;

class JobsService
{
  public function __construct(private JobsRepository $jobsRepo)
  {
  }
  // get stats
  public function getStats()
  {
    return [
      'total_jobs' => $this->jobsRepo->totalJobsCount(),
      'active_jobs' => $this->jobsRepo->activeJobsCount(),
      'draft_jobs' => $this->jobsRepo->draftJobsCount(),
      'closed_jobs' => $this->jobsRepo->closedJobsCount(),
    ];
  }
}