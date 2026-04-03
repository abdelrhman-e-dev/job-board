<?php

namespace App\Filament\Resources\Companies\Pages;

use App\Filament\Resources\Companies\CompanyResource;
use App\Models\Company;
use Filament\Actions\DeleteAction;
use Filament\Actions\ForceDeleteAction;
use Filament\Actions\RestoreAction;
use Filament\Notifications\Notification;
use Filament\Resources\Pages\EditRecord;

class EditCompany extends EditRecord
{
  protected static string $resource = CompanyResource::class;

  protected function getHeaderActions(): array
  {
    return [
      // update status to expired when click on delete action
      DeleteAction::make(),
      ForceDeleteAction::make(),
      RestoreAction::make()
    ];
  }
}
