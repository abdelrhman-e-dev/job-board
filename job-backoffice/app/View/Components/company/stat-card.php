<?php

namespace App\View\Components\company;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class StatCard extends Component
{
  /**
   * Create a new component instance.
   */
  public function __construct(
    public string $lable,
    public int $value,
    public string $icon,
    public string $color = 'primary',
    public ?int $trend = null,
  ) {
    //
  }

  /**
   * Get the view / contents that represent the component.
   */
  public function render(): View|Closure|string
  {
    return view('components.company.stat-card');
  }
}
