<?php

namespace App\View\Components\company;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class recentJobs extends Component
{
  /**
   * Create a new component instance.
   */
  public function __construct(
    public $recentJobs
  ) {
  }

  /**
   * Get the view / contents that represent the component.
   */
  public function render(): View|Closure|string
  {
    return view('components.company.recent-jobs');
  }
}
