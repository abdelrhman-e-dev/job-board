<?php
use App\Http\Controllers\Company\Auth\ForgotPasswordController;
use App\Http\Controllers\Company\Auth\InvitationController;
use App\Http\Controllers\Company\Auth\LoginController;
use App\Http\Controllers\Company\Auth\RegisterController;
use App\Models\User;
use Illuminate\Support\Facades\Route;
//NOTE: only non-logged-in users can access.
/**
 * Login page
 * Register page
 * Forgot password page
 * Reset password page
 * Verify email page
 * Invitation page
 */


Route::middleware('company.guest')->get('/', function () {
  return redirect()->route('company.login');
});
Route::middleware('company.guest')->group(function () {
  Route::get('/login', [LoginController::class, 'show'])->name('login');
  Route::post('/login', [LoginController::class, 'store'])->name('login.store');
  Route::get('/register', [RegisterController::class, 'show'])->name('register');
  Route::post('/register', [RegisterController::class, 'store'])->name('register.store');
  Route::get('/forget-password', [ForgotPasswordController::class, 'show'])->name('forget-password');
  Route::post('/forget-password', [ForgotPasswordController::class, 'store'])->name('forget-password.store');
  Route::get('/reset-password/{token}', [ForgotPasswordController::class, 'reset'])->name('reset-password');
  Route::post('/reset-password', [ForgotPasswordController::class, 'resetStore'])->name('reset-password.store');
  Route::get('/invitation/{token}', [InvitationController::class, 'show'])->name('invitation');
  Route::post('/invitation', [InvitationController::class, 'store'])->name('invitation.store');
});
Route::middleware('company.auth')->group(function () {
  Route::post('/logout', [LoginController::class, 'destroy'])->name('logout');
});
// Show verify email notice page
Route::get('email/verify', function () {
  return view('company.auth.verify-email');
})->name('verification.notice');
// Resend verification email
Route::post('/email/resend', function (Request $request) {
  $user = Auth::guard('company')->user();
  if ($user->hasVerifiedEmail()) {
    return redirect()->route('company.dashboard');
  }
  $user->sendEmailVerificationNotification();
  return back()->with('success-resend', 'Verification email resent successfully');
})->middleware('throttle:1,30')->name('verification.resend');
Route::get('email/verification/{id}/{hash}', function (Request $request, $id, $hash) {
  // find the user
  $user = User::findOrFail($id);
  // check if hash match 
  if (!hash_equals(sha1($user->email), $hash)) {
    abort(403, 'Invalid Verification Link');
  }
  // check if already verified
  if ($user->email_verified_at) {
    return redirect()->route('company.login');
  }
  // mark as verified
  $user->markEmailAsVerified();

  // Log user out
  Auth::guard('company')->logout();
  request()->session()->invalidate();
  request()->session()->regenerateToken();
  return redirect()->route('company.login')->with('success-verification', 'Email verified successfully. Your company account is pending admin approval. We will notify you once reviewed.');
})->middleware('signed')->name('email.verification');