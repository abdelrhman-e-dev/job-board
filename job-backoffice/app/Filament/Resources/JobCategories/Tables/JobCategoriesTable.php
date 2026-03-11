<?php

namespace App\Filament\Resources\JobCategories\Tables;

use App\Filament\Actions\JobCategoryActions\ActiveJobCategoryAction;
use App\Filament\Actions\JobCategoryActions\DeleteJobCategoryAction;
use App\Filament\Actions\JobCategoryActions\InactiveJobCategoryAction;
use App\Filament\Actions\JobCategoryActions\RestoreJobCategoryAction;
use App\Models\JobCategory;
use Filament\Actions\ActionGroup;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteAction;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Actions\ForceDeleteAction;
use Filament\Actions\ForceDeleteBulkAction;
use Filament\Actions\RestoreAction;
use Filament\Actions\RestoreBulkAction;
use Filament\Notifications\Notification;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Filters\TrashedFilter;
use Filament\Tables\Table;

class JobCategoriesTable
{
  public static function configure(Table $table): Table
  {
    return $table
      ->columns([
        TextColumn::make('name')
          ->searchable(),
        TextColumn::make('slug')
          ->searchable(),
        TextColumn::make('job_vacancies_count')
          ->label('Job Count')
          ->counts('jobVacancies')
          ->sortable(),
        TextColumn::make('status')
          ->label('Status')
          ->sortable()
          ->badge()
          ->color(fn($state): string => match ($state) {
            'active' => 'success',
            'inactive' => 'danger',
          })
          ->toggleable(),
        TextColumn::make('created_at')
          ->dateTime('d, m Y h:i A')
          ->sortable(),
        TextColumn::make('deleted_at')
          ->dateTime('d, m Y h:i A')
          ->sortable()
          ->placeholder('-'),
        TextColumn::make('updated_at')
          ->dateTime('d, m Y h:i A')
          ->sortable()
          ->toggleable(isToggledHiddenByDefault: true),
      ])
      ->filters([
        TrashedFilter::make(),
        SelectFilter::make('status')
          ->options([
            'active' => 'Active',
            'inactive' => 'Inactive',
          ]),
        SelectFilter::make('parent_id')
          ->label('Parent Category')
          ->options(
            JobCategory::where('status', 'active')
              ->whereNull('parent_id')
              ->pluck('name', 'category_id')
          )
      ])
      ->recordActions([
        EditAction::make(),
        ActiveJobCategoryAction::make(),
        ActionGroup::make([
          InactiveJobCategoryAction::make(),
          DeleteJobCategoryAction::make(),
          RestoreJobCategoryAction::make(),
        ]),
      ])
      ->toolbarActions([
        BulkActionGroup::make([
          DeleteBulkAction::make()
            ->label('Archive Selected')
            ->icon('heroicon-o-archive-box-arrow-down')
            ->before(function (DeleteBulkAction $action, $record) {
              if ($record->jobVacancies()->count() > 0 || $record->children()->count() > 0) {
                Notification::make()
                  ->warning()
                  ->title('Cannot archive job category')
                  ->body('Job category has job vacancies or children')
                  ->send();
                $action->halt();
              }
            })
            ->requiresConfirmation()
            ->modalHeading('Archive Job Category')
            ->modalDescription('Are you sure you want to archive this job category?')
            ->modalSubmitActionLabel('Yes, Archive'),
          ForceDeleteBulkAction::make(),
          RestoreBulkAction::make(),
        ]),
      ]);

  }
}
