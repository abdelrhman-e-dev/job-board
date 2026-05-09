<?php

use App\Http\Middleware\Company\CompanyApproved;
use App\Http\Middleware\Company\CompanyAuth;
use App\Http\Middleware\Company\CompanyRole;
use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;

return Application::configure(basePath: dirname(__DIR__))
  ->withRouting(
    web: __DIR__ . '/../routes/web.php',
    commands: __DIR__ . '/../routes/console.php',
    health: '/up',
    then: function () {
      Route::prefix('company')->middleware(['CompanyRole', 'CompanyAuth', 'CompanyApproved'])
        ->name('company.')
        ->group(function () {
          require __DIR__ . '/../routes/company.php';
        });
    }
  )
  ->withMiddleware(function (Middleware $middleware): void {
    $middleware->alias([
      'CompanyRole' => CompanyRole::class,
      'CompanyAuth' => CompanyAuth::class,
      'CompanyApproved' => CompanyApproved::class,
    ]);
  })
  ->withExceptions(function (Exceptions $exceptions): void {
    //
  })->create();
