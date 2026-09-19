<?php

namespace App\Http\Controllers\Company;

use App\Http\Controllers\Controller;
use App\Services\Company\JobsService;
use Illuminate\Http\Request;

class JobController extends Controller
{
    public function __construct(private JobsService $service)
  {

  }
    public function index()
    {
      return view('company.jobs.index',
    [
      'stats' => $this->service->getStats()
    ]
    );
    }
}
