<?php
use App\Http\Controllers\Company\Auth\ForgotPasswordController;
use App\Http\Controllers\Company\Auth\InvitationController;
use App\Http\Controllers\Company\Auth\LoginController;
use App\Http\Controllers\Company\Auth\RegisterController;
use Illuminate\Support\Facades\Route;
use Illuminate\Foundation\Auth\EmailVerificationRequest;

//NOTE: only non-logged-in users can access.
/**
 * Login page
 * Register page
 * Forgot password page
 * Reset password page
 * Verify email page
 * Invitation page  
 */
Route::middleware('company.guest')->group(function () {
  Route::get('/login', [LoginController::class, 'show'])->name('login');
  Route::post('/login', [LoginController::class, 'store'])->name('login.store');

  Route::get('/register', [RegisterController::class, 'show'])->name('register');
  Route::post('/register', [RegisterController::class, 'store'])->name('register.store');

  Route::get('/forget-password', [ForgotPasswordController::class, 'show'])->name('forget-password');
  Route::post('/forget-password', [ForgotPasswordController::class, 'store'])->name('forget-password.store');

  Route::get('/reset-password/{token}', [ForgotPasswordController::class, 'reset'])->name('reset-password');
  Route::post('/reset-password', [ForgotPasswordController::class, 'resetStore'])->name('reset-password.store');

  Route::get('/invitation/{token}' , [InvitationController::class , 'show'])->name('invitation');
  Route::post('/invitation' , [InvitationController::class , 'store'])->name('invitation.store');
});