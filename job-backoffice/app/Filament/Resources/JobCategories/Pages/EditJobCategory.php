<?php

namespace App\Filament\Resources\JobCategories\Pages;

use App\Filament\Actions\JobCategoryActions\DeleteJobCategoryAction;
use App\Filament\Actions\JobCategoryActions\RestoreJobCategoryAction;
use App\Filament\Resources\JobCategories\JobCategoryResource;
use Filament\Resources\Pages\EditRecord;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class EditJobCategory extends EditRecord
{
  protected static string $resource = JobCategoryResource::class;

  protected function getHeaderActions(): array
  {
    return [
      DeleteJobCategoryAction::make(),
      RestoreJobCategoryAction::make(),
    ];
  }
  public static function getRecordRouteBindingEloquentQuery(): Builder
  {
    return parent::getRecordRouteBindingEloquentQuery()
      ->withoutGlobalScopes([
        SoftDeletingScope::class,
      ]);
  }
}
