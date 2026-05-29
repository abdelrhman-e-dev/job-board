<?php

namespace App\View\Components\company;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class statusBadge extends Component
{
  /**
   * Create a new component instance.
   */
  protected array $statusColors = [
    'new' => 'bg-info-light text-info',
    'reviewing' => 'bg-warning-light text-warning',
    'shortlisted' => 'bg-secondary-container text-secondary',
    'interview' => 'bg-primary-fixed text-primary',
    'offer' => 'bg-primary-light text-primary',
    'hired' => 'bg-badge-approved-bg text-success',
    'rejected' => 'bg-badge-rejected-bg text-danger',
    'withdraw' => 'bg-neutral-100 text-neutral-500',
  ];
  public string $colorClasses;
  public string $label;
  public function __construct(public string $status)
  {
    $this->colorClasses = $this->statusColors[$status]
      ?? 'bg-neutral-100 text-neutral-500';

    $this->label = ucfirst($status);
  }

  /**
   * Get the view / contents that represent the component.
   */
  public function render(): View|Closure|string
  {
    return view('components.company.status-badge');
  }
}
