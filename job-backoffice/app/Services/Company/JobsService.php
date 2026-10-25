<?php

namespace App\Services\Company;

use App\Models\User;
use App\Repositories\Company\JobsRepository;
use Illuminate\Support\Facades\Auth;
use App\Exceptions\Company\Jobs\JobNotFoundException;
use App\Exceptions\Company\Jobs\ActionNotAvailableException;
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
      'expired_jobs' => $this->jobsRepo->expiredJobsCount($this->getHiringManagerId(Auth::guard('company')->user())),
      'blocked_jobs' => $this->jobsRepo->blockedJobsCount($this->getHiringManagerId(Auth::guard('company')->user())),
      'archived_jobs' => $this->jobsRepo->archivedJobsCount($this->getHiringManagerId(Auth::guard('company')->user())),
      'trashed_jobs' => $this->jobsRepo->trashedJobsCount($this->getHiringManagerId(Auth::guard('company')->user())),
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
  //jobs actions 
  public function canPublish(): bool
  {
    // total jobs count
    $totalJobsCount = $this->jobsRepo->totalJobsCount(null, 'draft');
    // company publish limit
    $publishLimit = $this->jobsRepo->companyPublishLimit();
    return $totalJobsCount < $publishLimit;
  }
  public function canPublishDaily()
  {
    $totalJobsPerDay = $this->jobsRepo->totalJobsPublishedPerDay();
    return $totalJobsPerDay < 4;
  }

  public function handleActionService(string $action, string $jobId, string $user_id)
  {

    // check if the action available for the job or not $job->available_actions
    $job = $this->jobsRepo->getJobById($jobId);
    if (!$job) {
      // trow exception error message "Job not found"
      throw new JobNotFoundException;
    }
    $availableActions = $job->available_actions;
    // the job is found, now check if the action is available for this job or not
    $actions = array_column($availableActions, 'action');
    if (!in_array($action, $actions, true)) {
      // trow exception error message "This action is not allowed for this job"
      throw new ActionNotAvailableException;
    }

  }
}