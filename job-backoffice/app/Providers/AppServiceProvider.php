<?php

namespace App\Providers;

use App\Services\Contracts\EmailServiceInterface;
use App\Services\EmailService;
use Filament\Facades\Filament;
use Filament\Support\Facades\FilamentView;
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\ServiceProvider;

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
  }
}
