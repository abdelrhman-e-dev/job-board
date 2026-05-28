<?php

namespace App\Providers;

use App\Services\Contracts\EmailServiceInterface;
use App\Services\EmailService;
use Filament\Auth\Notifications\ResetPassword;
use Filament\Facades\Filament;
use Filament\Support\Facades\FilamentView;
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Gate;
use App\Models\User;

class AppServiceProvider extends ServiceProvider
{
  /**
   * Register any application services.
   */
  public function register(): void
  {
    $this->app->bind(
      EmailServiceInterface::class,
      EmailService::class
    );
  }

  /**
   * Bootstrap any application services.
   */
  public function boot(): void
  {
    parent::register();
    FilamentView::registerRenderHook(
      'panels::body.end',
      fn(): string => Blade::render("@vite('resources/js/app.js')")
    );
    Gate::define('reset-user-password', function (?User $currentUser, User $userToCheck) {
      if (!$userToCheck->role) {
        return false;
      }
      return in_array($userToCheck->role_id, User::ROLES)
        && in_array($userToCheck->role->role_name, ['company-owner', 'hiring-manager']);
    });
    ResetPassword::createUrlUsing(function ($user, string $token) {
      return route('company.password.reset', [
        'token' => $token,
        'email' => $user->email,
      ]);
    });
  }
}
