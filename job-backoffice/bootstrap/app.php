<?php

use App\Http\Middleware\Company\CompanyApproved;
use App\Http\Middleware\Company\CompanyAuth;
use App\Http\Middleware\Company\CompanyGuest;
use App\Http\Middleware\Company\CompanyRole;
use App\Http\Middleware\Company\CompanyVerified;
use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;

return Application::configure(basePath: dirname(__DIR__))
  ->withRouting(
    web: __DIR__ . '/../routes/web.php',
    commands: __DIR__ . '/../routes/console.php',
    health: '/up',
    then: function () {
      Route::prefix('company')
        ->middleware('web')
        ->name('company.')
        ->group(function () {
          require __DIR__ . '/../routes/company.php';
        });
    }
  )
  ->withMiddleware(function (Middleware $middleware): void {
    $middleware->alias([
      'company.role' => CompanyRole::class,
      'company.auth' => CompanyAuth::class,
      'company.approved' => CompanyApproved::class,
      'company.guest' => CompanyGuest::class,
      'company.verified' => CompanyVerified::class,
    ]);
  })
  ->withExceptions(function (Exceptions $exceptions): void {
    //
  })->create();
