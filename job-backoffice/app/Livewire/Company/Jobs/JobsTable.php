<?php

namespace App\Livewire\Company\Jobs;

use App\Services\Company\JobsService;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Livewire\WithPagination;

class JobsTable extends Component
{
  use WithPagination;
  public int $perPage = 10;
  protected $paginationTheme = 'tailwind';
  public function render(JobsService $jobsService)
  {
    $Jobs = $jobsService->getAllJobs($this->perPage, user: Auth::guard('company')->user());
    return view(
      'livewire.company.jobs.jobs-table',
      [
        'jobs' => $Jobs
      ]
    );
  }
}
