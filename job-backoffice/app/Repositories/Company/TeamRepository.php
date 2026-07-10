<?php

namespace App\Repositories\Company;

use App\Models\ApplicationReview;
use App\Models\Company;
use App\Models\Interview;
use App\Models\JobVacancy;
use App\Models\Offer;
use App\Models\User;
use Carbon\Carbon;
use DB;
use Str;
class TeamRepository
{
  /**
   * Create a new class instance.
   */
  private $company_id = "";
  private $allowedRolles = [
    'company-owner' => User::ROLES['company-owner'],
    'hiring-manager' => User::ROLES['hiring-manager'],
  ];
  public function __construct()
  {
    $this->company_id = auth()->guard('company')->user()->company_id ?? "";
  }

  public function getCompanyMembers()
  {

    return User::where('company_id', $this->company_id)
      ->with('role')
      ->whereIn('role_id', $this->allowedRolles)
      ->get();
  }
  public function countHiringManagers()
  {
    return User::where('company_id', $this->company_id)
      ->where('role_id', User::ROLES['hiring-manager'])
      ->count();
  }
  public function findByEmail($email)
  {
    return User::where('email', $email)->where('company_id', $this->company_id)->first();
  }
  public function getMember($userId): ?User
  {
    return User::query()
      ->where('user_id', $userId)
      ->where('company_id', $this->company_id)
      ->select([
        'user_id',
        'first_name',
        'last_name',
        'email',
        'phone',
        'status',
        'role_id',
        'created_at',
      ])
      ->with('role:role_id,role_name')
      ->withCount([
        'jobs',
        'jobs as active_jobs_count' => function ($query) {
          $query->where('status', 'active');
        }
      ])
      ->first();
  }
  public function findById($id)
  {
    return User::where('user_id', $id)->where('company_id', $this->company_id)->first();
  }
  public function findByInvitationToken($invitation_token)
  {
    return User::where('invitation_token', $invitation_token)->first();
  }
  public function createInvitedUser($data, $token): User
  {
    $user = User::create([
      'first_name' => $data['first_name'],
      'last_name' => $data['last_name'],
      'email' => $data['email'],
      'password' => bcrypt("000000"),
      'role_id' => $this->allowedRolles['hiring-manager'],
      'company_id' => $this->company_id,
      'invitation_token' => $token,
      'invitation_expires_at' => Carbon::now()->addHours(48),
    ]);
    return $user;
  }
  public function updateInvitationToken($user_id, $token, $expires_at)
  {
    $user = User::find($user_id);
    $user->invitation_token = $token;
    $user->invitation_expires_at = $expires_at;
    $user->save();
    return $user;
  }
  public function acceptInvitation($user_id, $password)
  {
    $user = User::find($user_id);
    $user->password = bcrypt($password);
    $user->invitation_token = null;
    $user->invitation_expires_at = null;
    $user->invitation_accepted_at = Carbon::now()->utc();
    $user->save();
    $user->markEmailAsVerified();
    return $user;
  }
  public function deactivateUser($user_id)
  {
    $user = User::find($user_id);
    $user->status = 'inactive';
    $user->save();
    return $user;
  }
  public function hasActiveInterviews($user_id)
  {
    return Interview::where('interviewer_id', $user_id)->whereIn('status', ['active', 'pending'])->count();
  }
  public function hasActiveJobs($user_id)
  {
    return JobVacancy::where('posted_by', $user_id)->orWhere('closed_by', $user_id)->count();
  }
  public function hasActiveApplicationsReviewed($user_id)
  {
    return ApplicationReview::where('reviewer_id', $user_id)->count();
  }
  public function hasSentOffers($user_id)
  {
    return Offer::where('created_by', $user_id)->orWhere('updated_by', $user_id)->count();
  }
  public function reactivateUser($user_id)
  {

    $user = User::find($user_id);
    $user->status = 'active';
    $user->save();
    return $user;
  }
  // softDeleteUser($user_id)` — remove from team
  public function removeMember($user_id)
  {
    $user = User::where('user_id', $user_id)->where('company_id', $this->company_id)->first();
    if ($user) {
      $user->delete();
    }
    return $user;
  }

  public function getActiveInterviews($id)
  {
    return Interview::where('interviewer_id', $id)->whereIn('status', ['active', 'pending'])->get();
  }
  public function getActiveJobsCount($id)
  {
    return JobVacancy::where('posted_by', $id)->orWhere('closed_by', $id)->get()->count();
  }
  public function getOffersCount($id)
  {
    return Offer::where('created_by', $id)->orWhere('updated_by', $id)->get()->count();
  }
  public function getActiveInterviewsCount($id)
  {
    return Interview::where('interviewer_id', $id)->whereIn('status', ['active', 'pending'])->get()->count();
  }
  public function getActiveApplicationsReviewedCount($id)
  {
    return ApplicationReview::where('reviewer_id', $id)->get()->count();
  }
  //  move jobs/applications/offers/interviews to another hiring manager or owner
  public function reassignAssets($from_user_id, $to_user_id)
  {
    $user = User::find($from_user_id);
    DB::beginTransaction();
    try {
      // update posted_by
      JobVacancy::where('posted_by', $from_user_id)->update(['posted_by' => $to_user_id]);
      // update closed_by
      JobVacancy::where('closed_by', $from_user_id)->update(['closed_by' => $to_user_id]);
      // update interviewer_id
      Interview::where('interviewer_id', $from_user_id)->update(['interviewer_id' => $to_user_id]);
      // update reviewer_id
      ApplicationReview::where('reviewer_id', $from_user_id)->update(['reviewer_id' => $to_user_id]);
      // update created_by
      Offer::where('created_by', $from_user_id)->update(['created_by' => $to_user_id]);
      // update updated_by
      Offer::where('updated_by', $from_user_id)->update(['updated_by' => $to_user_id]);
      DB::commit();
    } catch (\Exception $e) {
      DB::rollBack();
      throw $e;
    }
    return $user;
  }
}
