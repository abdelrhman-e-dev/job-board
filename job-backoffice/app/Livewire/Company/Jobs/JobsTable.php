<?php

namespace App\Livewire\Company\Jobs;

use App\Services\Company\JobsService;
use Livewire\Component;
use Livewire\WithPagination;

class JobsTable extends Component
{
  use WithPagination;
  public int $perPage = 10;
  protected $paginationTheme = 'tailwind';
  public function render(JobsService $jobsService)
  {
    $Jobs = $jobsService->getAllJobs($this->perPage);
    return view(
      'livewire.company.jobs.jobs-table',
      [
        'jobs' => $Jobs
      ]
    );
  }
}
