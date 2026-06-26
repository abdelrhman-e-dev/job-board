<?php

namespace App\Livewire\Company\Team;

use App\Models\User;
use App\Services\Company\TeamService;
use Livewire\Component;
use Masmerise\Toaster\Toaster;

class MemberActions extends Component
{
  public User $member;
  public bool $confirmingResend = false;
  public bool $confirmingDeactivate = false;
  public bool $confirmingRemove = false;
  private TeamService $teamService;
  public function boot(TeamService $teamService)
  {
    $this->teamService = $teamService;
  }
  public function mount(User $member)
  {
    $this->member = $member;
  }
  public function confirmResend()
  {
    $this->confirmingResend = true;
  }

  public function cancelResend()
  {
    $this->confirmingResend = false;
  }
  public function resendInvite()
  {
    $this->teamService->resendInvitation($this->member->user_id);
    $this->confirmingResend = false;
    $this->dispatch('inviteResent');
    Toaster::success('Invitation resent to ' . $this->member->email);
  }
  public function reactivateMember()
  {
    $this->teamService->reactivateMember($this->member->user_id);
    $this->dispatch('memberReactivated'); // TeamList 
    Toaster::success($this->member->first_name . ' has been reactivated');
  }
  public function deactivateMember()
  {
    $this->teamService->deactivateMember($this->member->user_id);
    $this->dispatch('memberDeactivated'); // TeamList 
    Toaster::success($this->member->first_name . ' has been deactivated');
  }
  public function removeMember()
  {
    $this->teamService->removeMember($this->member->user_id);
    $this->dispatch('memberRemoved'); // TeamList 
    Toaster::success($this->member->first_name . ' has been removed');
  }
  public function render()
  {
    return view('livewire.company.team.member-actions');
  }
}
