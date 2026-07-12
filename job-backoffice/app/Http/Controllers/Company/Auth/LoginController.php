<?php

namespace App\Http\Controllers\Company\Auth;

use App\Exceptions\Company\Auth\CompanyPendingException;
use App\Exceptions\Company\Auth\CompanyRejectedException;
use App\Exceptions\Company\Auth\CompanySuspendedException;
use App\Exceptions\Company\Auth\InactiveUserException;
use App\Http\Controllers\Controller;
use App\Http\Requests\Company\Auth\LoginRequest;
use App\Services\Company\LoginService;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Validation\UnauthorizedException;

class LoginController extends Controller
{
  public function __construct(private LoginService $loginService)
  {
  }
  public function show()
  {
    return view('company.auth.login');
  }

  public function store(LoginRequest $request)
  {
    // Check rate limiting
    $request->authenticate();
    $credentials = $request->only('email', 'password');
    if (!$this->loginService->attempt($credentials, $request->boolean('remember'), $request->throttleKey())) {
      return back()->withErrors([
        'email' => 'These credentials do not match our records',
      ])->onlyInput('email');
    }
    $user = Auth::guard('company')->user();
    try {
      $this->loginService->checkRole($user);
      $this->loginService->checkStatus($user);
      $this->loginService->checkCompanyStatus($user);
    } catch (UnauthorizedException $e) {
      $this->destroy();
      return back()->withErrors(['email' => 'You are not authorized']);
    } catch (InactiveUserException $e) {
      $this->destroy();
      return back()->withErrors(['email' => 'Your account is deactivated']);
    } catch (CompanyPendingException $e) {
      $this->destroy();
      return view('company.auth.status.pending');
    } catch (CompanyRejectedException $e) {
      $this->destroy();
      return view('company.auth.status.rejected');
    } catch (CompanySuspendedException $e) {
      $this->destroy();
      return view('company.auth.status.suspended');
    }
    // Regenerate session to prevent fixation attacks
    $request->session()->regenerate();
    return redirect()->intended(route('company.dashboard'));
  }

  public function destroy()
  {
    Auth::guard('company')->logout();
    request()->session()->invalidate();
    request()->session()->regenerateToken();
    return redirect()->route('company.login');
  }
}