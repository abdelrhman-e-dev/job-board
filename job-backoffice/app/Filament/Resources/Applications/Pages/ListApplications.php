<?php

namespace App\Filament\Resources\Applications\Pages;

use App\Filament\Resources\Applications\ApplicationResource;
use App\Filament\Resources\Applications\Widgets\ApplicationQualityScore;
use App\Filament\Resources\Applications\Widgets\ApplicationToHire;
use App\Filament\Resources\Applications\Widgets\TimeToHire;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListApplications extends ListRecords
{
  protected static string $resource = ApplicationResource::class;

  protected function getHeaderActions(): array
  {
    return [

    ];
  }

  public function getHeaderWidgets(): array
  {
    return [
      ApplicationToHire::class,
      TimeToHire::class,
      ApplicationQualityScore::class,

    ];
  }
}
