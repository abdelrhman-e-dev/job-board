<?php

namespace App\Livewire\Company\Jobs;

use App\Services\Company\JobsService;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Livewire\WithPagination;

class JobsTable extends Component
{
  use WithPagination;
  public string $search = "";
  public string $status = "";
  public int $perPage = 10;
  protected $paginationTheme = 'tailwind';
  public function updateSearch()
  {
    $this->search = "";
  }
  public function updateStatus()
  {
    $this->status = "";
  }
  public function resetFilters()
  {
    $this->updateSearch();
    $this->updateStatus();
  }
  public function render(JobsService $jobsService)
  {
    $JobsStatus = Arr::sort($jobsService->getJobsStatus());
    $Jobs = $jobsService->getAllJobs($this->perPage, user: Auth::guard('company')->user(), search: $this->search, status: $this->status);
    return view(
      'livewire.company.jobs.jobs-table',
      [
        'jobs' => $Jobs,
        'JobsStatus' => $JobsStatus
      ]
    );
  }
}
