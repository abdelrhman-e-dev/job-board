<?php

namespace App\Http\Controllers\Company\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Company\InvitationRequest;
use App\Services\Company\TeamService;
use Illuminate\Http\Request;

class InvitationController extends Controller
{
  private TeamService $teamService;
  public function __construct(TeamService $teamService)
  {
    $this->teamService = $teamService;
  }
  public function show($id, $token)
  {
    try {
      $user = $this->teamService->verifyInvitationToken($token);
      return view('company.auth.invitation', compact('user'));
    } catch (\Exception $e) {
      return view('company.auth.invitation', ['exceptionError' => $e->getMessage()]);
    }
  }

  public function store(InvitationRequest $request)
  {
    $validator = $request->validated();
    $data = $this->teamService->acceptInvitation($validator['user_id'], $validator['password']);
    return redirect()->route('company.login')->with('success', 'Invitation accepted successfully. Your company account is pending admin approval. We will notify you once reviewed.');
  }
}
