<?php

namespace App\Http\Controllers\Company\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Company\Auth\LoginRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\RateLimiter;

class LoginController extends Controller
{
    public function show()
    {
        return view('company.auth.login');
    }

    public function store(LoginRequest $request)
    {
        // Check rate limiting
        $request->authenticate();

        $credentials = $request->only('email', 'password');

        if (!Auth::guard('company')->attempt($credentials, $request->boolean('remember'))) {
            // Increment rate limiter on failure
            RateLimiter::hit($request->throttleKey());

            Log::warning('Failed company login attempt', [
                'email' => $request->email,
                'ip'    => $request->ip(),
            ]);

            return back()->withErrors([
                'email' => 'These credentials do not match our records',
            ])->onlyInput('email');
        }

        $user = Auth::guard('company')->user();

        // Check user role
        if (!in_array($user->role->role_name, ['company-owner', 'hiring-manager'])) {
            Auth::guard('company')->logout();
            return back()->withErrors([
                'email' => 'You are not authorized to access this area',
            ]);
        }

        // Check user status
        if ($user->status !== 'Active') {
            Auth::guard('company')->logout();
            return back()->withErrors([
                'email' => 'Your account has been deactivated, please contact support',
            ]);
        }

        // Check company status
        $company = $user->company;

        if ($company->status === 'pending') {
            Auth::guard('company')->logout();
            return back()->withErrors([
                'email' => 'Your company account is pending approval',
            ]);
        }

        if ($company->status === 'rejected') {
            Auth::guard('company')->logout();
            return back()->withErrors([
                'email' => 'Your company account has been rejected',
            ]);
        }

        if ($company->status === 'suspended') {
            Auth::guard('company')->logout();
            return back()->withErrors([
                'email' => 'Your company account has been suspended',
            ]);
        }

        // Clear rate limiter on success
        RateLimiter::clear($request->throttleKey());

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