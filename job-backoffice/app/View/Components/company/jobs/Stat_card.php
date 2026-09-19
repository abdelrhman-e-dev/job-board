<?php

namespace App\View\Components\company\jobs;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class Stat_card extends Component
{
  /**
   * Create a new component instance.
   */
  public function __construct(
    public string $label,
    public int $value,
    public string $icon,
    public string $color = 'primary',
    public string $description = "",
  ) {

  }

  /**
   * Get the view / contents that represent the component.
   */
  public function render(): View|Closure|string
  {
    return view('components.company.jobs.jobs-stat-card');
  }
}
