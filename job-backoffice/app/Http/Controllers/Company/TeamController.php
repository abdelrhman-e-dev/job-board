<?php

namespace App\Http\Controllers\Company;

use App\Http\Controllers\Controller;
use App\Services\Company\TeamService;

class TeamController extends Controller
{

  public function __construct(private TeamService $teamService)
  {

  }
  public function index()
  {
    return view(
      'company.team.index',
      [
        'reachLimit' => $this->teamService->canInviteMember(),
        'current' => $this->teamService->countHiringManagers()
      ]
    );
  }
  public function member($id)
  {
    $data = $this->teamService->getMemberProfile($id);

    abort_if(!$data, 404);

    return view('company.team.member', compact('data'));
  }
}
