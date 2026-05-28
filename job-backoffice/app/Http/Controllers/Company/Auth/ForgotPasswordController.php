<?php

namespace App\Http\Controllers\Company\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Company\Auth\ForgetPasswordRequest;
use App\Http\Requests\Company\Auth\ResetPasswordRequest;
use App\Models\User;
use Illuminate\Auth\Events\PasswordReset;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\Str;

class ForgotPasswordController extends Controller
{
  public function show()
  {
    return view('company.auth.forget-password');
  }

  public function store(ForgetPasswordRequest $request)
  {
    $validated = $request->safe()->only('email');
    // get the user with role
    $user = User::with('role')->where('email', $validated['email'])->first();
    // check user role [company-owner , hiring manager]
    if (!$user) {
      return back()->with('error', 'User not found');
    }
    if (!Gate::forUser(null)->allows('reset-user-password', $user)) {
      return back()->with('error', 'User is not authorized to reset password');
    }
    if ($user->status !== 'active') {
      return back()->with('error', 'User is not active');
    }
    $token = $user->generateAndSaveResetToken();
    $user->sendPasswordResetNotification($token);
    return back()->with('success', 'We have emailed your password reset link.');
  }

  public function reset(Request $request)
  {
    return view('company.auth.reset-password', [
      'token' => $request->token,
      'email' => $request->email,
    ]);
  }

  public function update(ResetPasswordRequest $request)
  {
    // Rate limit: 5 attempts per minute
    if (RateLimiter::tooManyAttempts('reset-password:' . $request->ip(), 5)) {
      return back()->withErrors([
        'email' => 'Too many attempts. Please try again later.'
      ]);
    }

    RateLimiter::hit('reset-password:' . $request->ip());
    $status = Password::broker('company_users')->reset(
      $request->only('email', 'password', 'password_confirmation', 'token'),
      function (User $user, string $password) {
        // Check user role
        if (!in_array($user->role->role_name, ['company-owner', 'hiring-manager'])) {
          abort(403, 'Unauthorized');
        }

        // Check user status
        if ($user->status !== 'active') {
          return back()->with('error', 'User is not active');
        }

        // Update password
        $user->forceFill([
          'password' => Hash::make($password),
          'remember_token' => Str::random(60),
        ])->save();

        // Fire password reset event
        event(new PasswordReset($user));
        $user->sendCompanyPasswordUpdatedNotification();
      }
    );

    // Check if reset was successful
    if ($status === Password::PASSWORD_RESET) {
      return redirect()->route('company.login')
        ->with('success', 'Password reset successfully, please login');
    }

    // Reset failed
    return back()
      ->withInput($request->only('email'))
      ->withErrors(['email' => __($status)]);
  }
}
