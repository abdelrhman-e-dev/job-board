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
  public function handle(Request $request, Closure $next, string $role): Response
  {
    $user = Auth::guard('company')->user();
    if ($user->role->role_name !== $role) {
      abort(403, 'Unauthorized');
    }
    return $next($request);
  }
}
