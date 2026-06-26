<?php

namespace App\Repositories\Company;

use App\Models\Company;
use App\Models\User;
use Carbon\Carbon;
use Str;
class TeamRepository
{
  /**
   * Create a new class instance.
   */
  private $company_id = "";
  private $allowedRolles = [
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
      ->latest()
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
    /**
     * before deactivation:
     *  check if the hiring manager has any active jobs
     *  check if the hiring manager has any active interviews
     */
    $user = User::find($user_id);
    $user->status = 'inactive';
    $user->save();
    return $user;
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
    /**
     * before removing:
     *  check if the hiring manager has any active jobs
     *  check if the hiring manager has any active interviews
     */
    $user = User::where('user_id', $user_id)->where('company_id', $this->company_id)->first();
    if ($user) {
      $user->forceDelete();
    }
    return $user;
  }

  //  move jobs/applications to owner
  // public function reassignAssets($from_user_id, $to_user_id)
  // {
  //   $user = User::find($from_user_id);
  //   $user->company_id = $to_user_id;
  //   $user->save();
  //   return $user;
  // }
}
