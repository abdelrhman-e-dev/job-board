<?php

namespace App\Filament\Resources\Users\Pages;

use App\Filament\Resources\Users\UserResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;
use App\Filament\Resources\Users\Widgets\UseresStats;
class ListUsers extends ListRecords
{
  protected static string $resource = UserResource::class;
  protected static ?string $title = 'Users Management';
  protected function getHeaderActions(): array
  {
    return [
      CreateAction::make(),
    ];
  }

  protected function getHeaderWidgets(): array
  {
    return [
      UseresStats::class,
    ];
  }
}
