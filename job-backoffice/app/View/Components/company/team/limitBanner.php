<?php

namespace App\View\Components\company\team;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class limitBanner extends Component
{
  /**
   * Create a new component instance.
   */
  public function __construct(
    public $reachLimit,
    public $current,
  ) {
    //
  }

  /**
   * Get the view / contents that represent the component.
   */
  public function render(): View|Closure|string
  {
    return view('components.company.team.limit-banner');
  }
}
