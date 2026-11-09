<?php

namespace App\Livewire\Company\Jobs;

use Livewire\Attributes\On;
use Livewire\Component;

class JobConfirmationModel extends Component
{
  public bool $showConfirmation = false;
  public ?string $jobId = null;
  public ?string $newDeadline = null;

  #[On('show-deadline-modal')] // Listen for the 'show-deadline-modal' event
  public function showDeadlineModal(string $jobId): void
  {
    $this->jobId = $jobId;
    $this->showConfirmation = true;
  }

  public function render()
  {
    return view('livewire.company.jobs.job-confirmation-model');
  }
}
