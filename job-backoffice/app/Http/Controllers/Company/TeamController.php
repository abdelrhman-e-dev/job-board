<?php

namespace App\Http\Controllers\Company;

use App\Http\Controllers\Controller;
use App\Services\Company\TeamService;

class TeamController extends Controller
{

  public function __construct(private TeamService $tesmService)
  {

  }
  public function index()
  {
    return view(
      'company.team.index',
      [
        'reachLimit' => $this->tesmService->canInviteMember(),
        'current' => $this->tesmService->countHiringManagers()
      ]
    );
  }
}
