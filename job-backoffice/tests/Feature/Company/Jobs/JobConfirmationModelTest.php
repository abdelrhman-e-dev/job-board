<?php

use App\Livewire\Company\Jobs\JobConfirmationModel;
use Livewire\Livewire;

it('opens when the invalid deadline event is dispatched', function () {
    Livewire::test(JobConfirmationModel::class)
        ->dispatch('show-deadline-modal', jobId: 'job-123')
        ->assertSet('showConfirmation', true)
        ->assertSet('jobId', 'job-123')
        ->assertSee('The deadline check failed. Choose a new date to continue.');
});
