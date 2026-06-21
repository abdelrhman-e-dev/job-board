<?php

namespace App\Livewire\Company\Team;

use App\Services\Company\TeamService;
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
  public function render()
  {
    return view('livewire.company.team.team-list', [
      'members' => $this->teamservice->getMembers()
    ]);
  }
}
