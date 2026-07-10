<?php

namespace App\Services\Company;

use App\Exceptions\Company\EmailAlreadyExistsException;
use App\Exceptions\Company\ReassignToMember;
use App\Exceptions\Company\TeamLimitReachedException;
use App\Mail\Company\InvitationEmail;
use App\Models\User;
use App\Repositories\Company\TeamRepository;
use DB;
use Mail;
use Masmerise\Toaster\Toaster;
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
    if ($this->canInviteMember()) {
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
  public function resendInvitation($id)
  {
    $user = $this->teamRepository->findById($id);
    if (!$user) {
      throw new \Exception('User not found');
    }
    $token = Str::random(64);
    $user->update([
      'invitation_token' => $token,
      'invitation_expires_at' => now()->addDays(7),
    ]);
    $this->sendInvitationMail($user, $token);
  }
  public function deactivateMember($id)
  {
    /**
     * before deactivation:
     *  check if the hiring manager has any active interviews , active jobs , sent offers , had applications reviews
     */
    if ($this->teamRepository->hasActiveInterviews($id)) {
      throw new ReassignToMember('Hiring manager has active interviews. Please reassign them before deactivating.', [
        'interviews' => $this->teamRepository->getActiveInterviews($id),
      ]);
    }
    if ($this->teamRepository->hasActiveJobs($id)) {
      throw new \Exception('Hiring manager has active jobs. Please reassign them before deactivating.');
    }
    if ($this->teamRepository->hasSentOffers($id)) {
      throw new \Exception('Hiring manager has sent offers. Please reassign them before deactivating.');
    }
    if ($this->teamRepository->hasActiveApplicationsReviewed($id)) {
      throw new \Exception('Hiring manager has active applications reviews. Please reassign them before deactivating.');
    }
    $user = $this->teamRepository->deactivateUser($id);
    return $user;
  }
  public function reactivateMember($id)
  {
    $user = $this->teamRepository->reactivateUser($id);
    return $user;
  }
  public function removeMember($id)
  {
    /**
     * before removing: 
     *  check if the hiring manager has any active interviews
     */
    if ($this->teamRepository->hasActiveInterviews($id)) {
      throw new \Exception('Hiring manager has active interviews. Please reassign them before removing.');
    }
    $user = $this->teamRepository->removeMember($id);
    return $user;
  }
  // get active jobs
  public function getActiveJobsCount($id)
  {
    return $this->teamRepository->getActiveJobsCount($id);
  }
  public function getOffersCount($id)
  {
    return $this->teamRepository->getOffersCount($id);
  }
  public function getActiveInterviewsCount($id)
  {
    return $this->teamRepository->getActiveInterviewsCount($id);
  }
  public function getActiveApplicationsReviewedCount($id)
  {
    return $this->teamRepository->getActiveApplicationsReviewedCount($id);
  }
  public function reassignAssets($from_user_id, $to_user_id)
  {
    return $this->teamRepository->reassignAssets($from_user_id, $to_user_id);
  }
}
