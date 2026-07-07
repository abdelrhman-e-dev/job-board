<?php

namespace App\Livewire\Company\Team;

use App\Exceptions\Company\ReassignToMember;
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
  public bool $reassign = false;
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
  public function cancelReassign()
  {
    $this->reassign = false;
  }
  public function resendInvite()
  {
    try {
      $this->teamService->resendInvitation($this->member->user_id);
      Toaster::success('Invitation resent to ' . $this->member->email);
    } catch (\Exception $e) {
      Toaster::error($e->getMessage());
    } finally {
      $this->confirmingResend = false;
      $this->dispatch('inviteResent');
    }
  }
  public function reactivateMember()
  {
    try {
      $this->teamService->reactivateMember($this->member->user_id);
      Toaster::success($this->member->first_name . ' has been reactivated');
    } catch (\Exception $e) {
      Toaster::error($e->getMessage());
    } finally {
      $this->dispatch('memberReactivated'); // TeamList 
    }
  }
  public function deactivateMember()
  {
    try {
      $this->teamService->deactivateMember($this->member->user_id);
      Toaster::success($this->member->first_name . ' has been deactivated');
    } catch (ReassignToMember $e) {
      $this->reassign = true;
    } catch (\Exception $e) {
      Toaster::error($e->getMessage());
    } finally {
      $this->confirmingDeactivate = false;
      $this->dispatch('memberDeactivated'); // TeamList 
    }
  }
  public function removeMember()
  {
    try {
      $this->teamService->removeMember($this->member->user_id);
      Toaster::success($this->member->first_name . ' has been removed');
    } catch (\Exception $e) {
      Toaster::error($e->getMessage());
    } finally {
      $this->confirmingRemove = false;
      $this->dispatch('memberRemoved'); // TeamList 
    }
  }
  public function render()
  {
    return view('livewire.company.team.member-actions');
  }
}
