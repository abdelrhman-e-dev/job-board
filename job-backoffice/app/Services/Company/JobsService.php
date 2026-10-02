<?php

namespace App\Services\Company;

use App\Models\User;
use App\Repositories\Company\JobsRepository;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\Auth;

class JobsService
{
  public function __construct(private JobsRepository $jobsRepo)
  {
  }
  private function getHiringManagerId(User $user): ?string
  {
    return $user->isOwner() ? null : $user->user_id;
  }
  // get stats
  public function getStats()
  {
    return [
      'total_jobs' => $this->jobsRepo->totalJobsCount($this->getHiringManagerId(Auth::guard('company')->user())),
      'active_jobs' => $this->jobsRepo->activeJobsCount($this->getHiringManagerId(Auth::guard('company')->user())),
      'draft_jobs' => $this->jobsRepo->draftJobsCount($this->getHiringManagerId(Auth::guard('company')->user())),
      'closed_jobs' => $this->jobsRepo->closedJobsCount($this->getHiringManagerId(Auth::guard('company')->user())),
    ];
  }
  // get all jobs
  public function getAllJobs(int $perPage, User $user, ?string $search, ?string $status)
  {
    $managerId = $user->isOwner() ? null : $user->user_id;
    return $this->jobsRepo->getAllJobs($perPage, $managerId, $search, $status);
  }
  // get jobs status 
  public function getJobsStatus()
  {
    return $this->jobsRepo->getStatus();
  }
}