<?php

namespace App\Http\Controllers\Company;

use App\Http\Controllers\Controller;
use App\Services\Company\DashboardService;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
  public function __construct(private DashboardService $service)
  {

  }
  public function index()
  {
    return view('company.dashboard.index', [
      'stats' => $this->service->getStats(),
      'recentApplications' => $this->service->getRecentApplications(),
      'missingData' => $this->service->getMissingData()['missing'],
      'missingPercentage' => $this->service->getMissingData()['percentage'],
    ]);
  }
}
