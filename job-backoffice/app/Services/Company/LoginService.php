<?php

namespace App\Services\Company;

use App\Exceptions\Company\Auth\CompanyPendingException;
use App\Exceptions\Company\Auth\CompanyRejectedException;
use App\Exceptions\Company\Auth\CompanySuspendedException;
use App\Exceptions\Company\Auth\InactiveUserException;
use Auth;
use Illuminate\Validation\UnauthorizedException;
use Log;
use Illuminate\Support\Facades\RateLimiter;
class LoginService
{
  /**
   * Create a new class instance.
   */
  public function __construct()
  {
    //
  }
public function attempt($credentials, $remember, $throttleKey)
{
    $result = Auth::guard('company')->attempt($credentials, $remember);
    
    if (!$result) {
        RateLimiter::hit($throttleKey);
        $this->logFailedAttempt($credentials['email'], '');
        return false;
    }
    
    RateLimiter::clear($throttleKey);
    return true;
}
  public function logFailedAttempt($email, $ip)
  {
    Log::warning('Failed company login attempt', [
      'email' => $email,
      'ip' => $ip,
    ]);
  }
  public function checkRole($user)
  {
    if (!in_array($user->role->role_name, ['company-owner', 'hiring-manager'])) {
      throw new UnauthorizedException();
    }
  }
  public function checkStatus($user)
  {
    if ($user->status !== 'active') {
      throw new InactiveUserException();
    }
  }
  public function checkCompanyStatus($user)
  {
    $companyStatus = $user->company->status;

    if ($companyStatus === 'pending') {
      throw new CompanyPendingException();
    }

    if ($companyStatus === 'rejected') {
      throw new CompanyRejectedException();
    }

    if ($companyStatus === 'suspended') {
      throw new CompanySuspendedException();
    }
  }
}