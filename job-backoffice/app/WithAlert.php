<?php

namespace App;

use Livewire\Component;
use App\Services\Alert\Alert;
trait WithAlert
{
  public ?array $currentAlert = null;

  public function showAlert(Alert $alert)
  {
    if ($alert instanceof Alert) {
      $this->currentAlert = $alert->toArray();
    } else {
      $this->currentAlert = $alert;
    }
  }

  public function dismissAlert()
  {
    $this->currentAlert = null;
  }
}
