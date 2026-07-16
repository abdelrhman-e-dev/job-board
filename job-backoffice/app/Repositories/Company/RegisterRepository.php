<?php

namespace App\Repositories\Company;

use App\Models\Company;
use App\Models\User;
use DB;
use Hash;
use Str;

class RegisterRepository
{
  /**
   * Create a new class instance.
   */
  public function __construct()
  {
    //
  }
  // store the user 
  public function register($userData, $companyData)
  {
    $user = DB::transaction(function () use ($userData, $companyData) {
      $user = User::create([
        'first_name' => $userData->first_name,
        'last_name' => $userData->last_name,
        'email' => $userData->email,
        'password' => $userData->password,
        'role_id' => $userData->roleId,
      ]);
      $company = Company::create([
        'name' => $companyData->company_name,
        'slug' => $companyData->company_slug,
        'industry' => $companyData->industry,
        'size' => $companyData->size,
        'city' => $companyData->city,
        'country' => $companyData->country,
        'owner_id' => $user->user_id,
        'status' => $companyData->status,
      ]);
      $user->update([
        'company_id' => $company->company_id,
      ]);
      return $user;
    });
    return $user;
  }
}
