<?php

namespace App\Services\Company;

use App\Exceptions\Company\EmailAlreadyExistsException;
use App\Exceptions\Company\TeamLimitReachedException;
use App\Mail\Company\InvitationEmail;
use App\Models\User;
use App\Repositories\Company\TeamRepository;
use DB;
use Mail;
use Str;

class TeamService
{
  private TeamRepository $teamRepository;
  /**
   * Create a new class instance.
   */
  public function __construct(TeamRepository $teamRepository)
  {
    $this->teamRepository = $teamRepository;
  }
  public function getMembers()
  {
    return $this->teamRepository->getCompanyMembers();
  }
  public function canInviteMember()
  {
    return $this->teamRepository->countHiringManagers() >= 5;
  }
  public function countHiringManagers()
  {
    return $this->teamRepository->countHiringManagers();
  }
  public function inviteMember(array $data): User
  {
    if (!$this->canInviteMember()) {
      throw new TeamLimitReachedException();
    }

    if ($this->teamRepository->findByEmail($data['email'])) {
      throw new EmailAlreadyExistsException();
    }
    $token = Str::random(64);
    $user = DB::transaction(function () use ($data, $token) {
      return $this->teamRepository->createInvitedUser($data, $token);
    });
    try {
      $this->sendInvitationMail($user, $token);
    } catch (\Exception $e) {
      throw new \Exception('Invitation email failed for ' . $user->email . ': ' . $e->getMessage());
    }

    return $user;
  }
  public function sendInvitationMail($user, $token)
  {
    Mail::to($user->email)->send(new InvitationEmail($user, $token));
  }
  public function verifyInvitationToken($token)
  {
    $user = User::where('invitation_token', $token)->first();

    if (!$user) {
      throw new \Exception('Invalid invitation token');
    }
    if ($user->invitation_expires_at->utc() < now()->utc()) {
      throw new \Exception('Invitation token has expired');
    }
    return $user;
  }
  public function acceptInvitation($id, $password, $token)
  {
    // verify token
    $user = $this->teamRepository->findByInvitationToken($token);
    if (!$user) {
      throw new \Exception('Invalid invitation token');
    }
    return $this->teamRepository->acceptInvitation($id, $password);
  }
}
