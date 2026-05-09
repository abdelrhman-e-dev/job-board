<?php

namespace App\Http\Middleware\Company;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class CompanyApproved
{
  /**
   * Handle an incoming request.
   *
   * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
   */
  public function handle(Request $request, Closure $next): Response
  {
    // get the auth user 
    // get the company which belong to this user
    // check status and redirect 
    $user = Auth::guard('company')->user();
    $company = $user->company;
    if ($company->status === 'pending') {
      return redirect()->route('company.pending');
    }

    if ($company->status === 'rejected') {
      return redirect()->route('company.rejected');
    }

    if ($company->status === 'suspended') {
      return redirect()->route('company.suspended');
    }
    return $next($request);
  }
}
