<?php

namespace App\Livewire\Company\Team;

use App\Exceptions\Company\ReassignToMember;
use App\Models\User;
use App\Services\Company\TeamService;
use Livewire\Component;
use Masmerise\Toaster\Toaster;
use Livewire\Attributes\On;

class MemberActions extends Component
{
  public User $member;
  public bool $confirmingResend = false;
  public bool $confirmingDeactivate = false;
  public bool $confirmingRemove = false;
  public bool $reassign = false;
  public int $activeJobs = 0;
  public int $offersCount = 0;
  public int $activeInterviewsCount = 0;
  public string $assignTo = "";
  public string $modalLable = "";
  public $comapnyMemebers;
  public int $activeApplicationsReviewedCount = 0;
  private TeamService $teamService;
  public function boot(TeamService $teamService)
  {
    $this->teamService = $teamService;
  }

  public function mount(User $member)
  {
    $this->member = $member;
    $this->comapnyMemebers = $this->teamService->getMembers();
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
      $this->dispatch('inviteResent', ['userId' => $this->member->user_id]);
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
      $this->dispatch('memberReactivated', ['userId' => $this->member->user_id]); // TeamList 
    }
  }
  public function deactivateMember()
  {
    try {
      $this->teamService->deactivateMember($this->member->user_id);
      Toaster::success($this->member->first_name . ' has been deactivated');
    } catch (ReassignToMember $e) {
      $this->activeJobs = $this->teamService->getActiveJobsCount($this->member->user_id);
      $this->offersCount = $this->teamService->getOffersCount($this->member->user_id);
      $this->activeInterviewsCount = $this->teamService->getActiveInterviewsCount($this->member->user_id);
      $this->activeApplicationsReviewedCount = $this->teamService->getActiveApplicationsReviewedCount($this->member->user_id);
      $this->reassign = true;
    } catch (\Exception $e) {
      Toaster::error($e->getMessage());
    } finally {
      $this->confirmingDeactivate = false;
      $this->dispatch('memberDeactivated', ['userId' => $this->member->user_id]); // TeamList 
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
      $this->dispatch('memberRemoved', ['userId' => $this->member->user_id]); // TeamList 
    }
  }
  public function reassignAssets()
  {
    try {
      $this->teamService->reassignAssets($this->member->user_id, $this->assignTo);
      if ($this->confirmingRemove) {
        $this->removeMember();
      } elseif ($this->confirmingDeactivate) {
        $this->deactivateMember();
      }
      Toaster::success($this->member->first_name . ' has been reassigned');
    } catch (\Exception $e) {
      Toaster::error($e->getMessage());
    } finally {
      $this->reassign = false;
      $this->dispatch('memberReassigned', ['userId' => $this->member->user_id]); // TeamList 
    }
  }
  #[On('memberDeactivated')]
  #[On('memberReactivated')]
  public function refreshMemberData($payload)
  {
    if (isset($payload['userId']) && $payload['userId'] == $this->member->user_id) {
      $this->member->refresh();
    }
  }
  public function goToMember()
  {
    return $this->redirect(route('company.team.member', $this->member->user_id), navigate: true);
  }
  public function render()
  {
    return view('livewire.company.team.member-actions');
  }
}
