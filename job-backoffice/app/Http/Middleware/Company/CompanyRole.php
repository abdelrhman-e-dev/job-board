<?php

namespace App\Http\Middleware\Company;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class CompanyRole
{
  /**
   * Handle an incoming request.
   *
   * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
   */
  public function handle(Request $request, Closure $next): Response
  {
    $user = Auth::guard('company')->user();
    $allowedRoles = ['company-owner', 'hiring-manager'];
    if (!$user || !in_array($user->role->role_name, $allowedRoles)) {
      abort(403, 'Unauthorized');
    }
    return $next($request);
  }
}
