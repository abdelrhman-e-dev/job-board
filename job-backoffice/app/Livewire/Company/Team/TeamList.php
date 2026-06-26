<?php

namespace App\Livewire\Company\Team;

use App\Services\Company\TeamService;
use Livewire\Attributes\On;
use Livewire\Component;
use Livewire\WithPagination;

class TeamList extends Component
{

  use WithPagination;
  private TeamService $teamservice;
  public function boot(TeamService $teamservice)
  {
    $this->teamservice = $teamservice;
  }


  #[On('memberDeactivated')]
  #[On('memberReactivated')]
  #[On('memberRemoved')]
  #[On('memberInvited')]
  public function refreshMembers()
  {
    
  }
  public function render()
  {
    return view('livewire.company.team.team-list',[
      'members' => $this->teamservice->getMembers(),
    ]);
  }
}