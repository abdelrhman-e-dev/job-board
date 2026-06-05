<?php

namespace App\Http\Controllers\Company;

use App\Http\Controllers\Controller;
use App\Services\Company\DashboardService;

class ProfileController extends Controller
{
  public function __construct(private DashboardService $service)
  {

  }
  public function index()
  {
    return view('company.profile.index', [
      'missingData' => $this->service->getMissingData()['missing'],
      'missingPercentage' => $this->service->getMissingData()['percentage'],
    ]);
  }
}
