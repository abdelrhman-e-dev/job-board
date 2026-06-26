<?php

namespace App\Livewire\Company\Team;

use App\Services\Company\TeamService;
use Livewire\Component;
use Masmerise\Toaster\Toaster;

class InviteMemberModal extends Component
{
  private TeamService $teamService;
  public function boot(TeamService $teamService)
  {
    $this->teamService = $teamService;
  }
  public $first_name;
  public $last_name;
  public $email;

  public function rules()
  {
    return [
      "first_name" => "required|string|max:255|min:3",
      "last_name" => "required|string|max:255|min:3",
      "email" => "required|email|unique:users,email",
    ];
  }
  public function messages()
  {
    return [
      "first_name.required" => "First name is required",
      "first_name.string" => "First name must be a string",
      "first_name.max" => "First name cannot be more than 255 characters",
      "first_name.min" => "First name cannot be less than 3 characters",
      "last_name.required" => "Last name is required",
      "last_name.string" => "Last name must be a string",
      "last_name.max" => "Last name cannot be more than 255 characters",
      "last_name.min" => "Last name cannot be less than 3 characters",
      "email.required" => "Email is required",
      "email.email" => "Email must be a valid email address",
      "email.unique" => "Email already exists",
    ];
  }
  public function inviteMember()
  {
    $this->validate();
    $data = [
      "first_name" => $this->first_name,
      "last_name" => $this->last_name,
      "email" => $this->email,
    ];
    try {
      $this->teamService->inviteMember($data);
      Toaster::success('Member invited successfully!');
      $this->reset(['first_name', 'last_name', 'email']);
      $this->dispatch('memberInvited');
      $this->dispatch('close-invite-modal');
    } catch (\Exception $e) {
      Toaster::error($e->getMessage());
    }
  }
  public function render()
  {
    return view('livewire.company.team.invite-member-modal');
  }
}
