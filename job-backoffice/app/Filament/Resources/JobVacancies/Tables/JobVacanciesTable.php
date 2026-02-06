<?php

namespace App\Filament\Resources\JobVacancies\Tables;

use Filament\Forms;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Actions\ForceDeleteBulkAction;
use Filament\Actions\RestoreBulkAction;
use Filament\Actions\ViewAction;
use Filament\Forms\Components\Placeholder;
use Filament\Schemas\Components\Grid;
use Filament\Schemas\Components\Section;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Filters\TrashedFilter;
use Filament\Tables\Table;
use Illuminate\Support\HtmlString;

class JobVacanciesTable
{
  public static function configure(Table $table): Table
  {
    return $table
      ->columns([
        TextColumn::make('title')
          ->searchable()
          ->sortable()
          ->weight('medium')
          ->description(fn($record) => $record->company->name ?? 'N/A'),

        TextColumn::make('jobCategory.name')
          ->label('Category')
          ->badge()
          ->searchable()
          ->sortable(),

        TextColumn::make('type')
          ->badge()
          ->sortable(),

        TextColumn::make('level')
          ->badge()
          ->sortable(),

        TextColumn::make('status')
          ->badge()
          ->sortable(),

        TextColumn::make('applications_count')
          ->label('Applications')
          ->counts('applications')
          ->numeric()
          ->sortable(),

        TextColumn::make('deadline')
          ->date()
          ->sortable(),
      ])
      ->filters([
        SelectFilter::make('status'),
        SelectFilter::make('type'),
        SelectFilter::make('level'),
        TrashedFilter::make(),
      ])
      ->actions([
        ViewAction::make()
          ->modalHeading(fn($record) => $record->title)
          ->modalWidth('7xl')
          ->form([
            Section::make('Job Information')
              ->schema([
                Grid::make(4)
                  ->schema([
                    Placeholder::make('title')
                      ->label('Job Title')
                      ->content(fn($record) => $record->title),
                    Placeholder::make('company')
                      ->label('Company')
                      ->content(fn($record) => $record->company->name ?? 'N/A'),
                    Placeholder::make('category')
                      ->label('Category')
                      ->content(fn($record) => $record->jobCategory->name ?? 'N/A'),
                    Placeholder::make('posted_by')
                      ->label('Posted By')
                      ->content(fn($record) => $record->user->name ?? 'N/A'),
                  ]),
              ])
              ->collapsible(),

            Section::make('Job Details')
              ->schema([
                Grid::make(4)
                  ->schema([
                    Placeholder::make('type')
                      ->label('Employment Type')
                      ->content(fn($record) => $record->type),

                    Placeholder::make('level')
                      ->label('Experience Level')
                      ->content(fn($record) => $record->level),

                    Placeholder::make('status')
                      ->label('Status')
                      ->content(fn($record) => $record->status),

                    Placeholder::make('location')
                      ->label('Location')
                      ->content(fn($record) => $record->location),
                  ]),
              ])
              ->collapsible()
              ->collapsed(),

            Section::make('Salary Information')
              ->schema([
                Grid::make(4)
                  ->schema([
                    Placeholder::make('salary_min')
                      ->label('Minimum Salary')
                      ->content(fn($record) => $record->salary_currency . ' ' . number_format($record->salary_min ?? 0)),

                    Placeholder::make('salary_max')
                      ->label('Maximum Salary')
                      ->content(fn($record) => $record->salary_currency . ' ' . number_format($record->salary_max ?? 0)),

                    Placeholder::make('salary_currency')
                      ->label('Currency')
                      ->content(fn($record) => $record->salary_currency ?? 'USD'),
                  ]),
              ])
              ->collapsible()
              ->collapsed(),

            Section::make('Description & Requirements')
              ->schema([
                Grid::make(3)
                ->schema([
                  Placeholder::make('description')
                  ->label('Description')
                  ->content(fn($record) => new HtmlString(
                    str($record->description ?? '')->markdown()
                  )),

                Placeholder::make('requirements')
                  ->label('Requirements')
                  ->content(fn($record) => new HtmlString(
                    str($record->requirements ?? '')->markdown()
                  )),

                Placeholder::make('benefits')
                  ->label('Benefits')
                  ->content(fn($record) => new HtmlString(
                    str($record->benefits ?? '')->markdown()
                  )),
                ])
              ])
              ->collapsible()
              ->collapsed(),

            Section::make('Statistics')
              ->schema([
                Grid::make(3)
                  ->schema([
                    Placeholder::make('views_count')
                      ->label('Total Views')
                      ->content(fn($record) => number_format($record->views_count ?? 0)),

                    Placeholder::make('applications_count')
                      ->label('Total Applications')
                      ->content(fn($record) => number_format($record->applications_count ?? 0)),

                    Placeholder::make('deadline')
                      ->dateTime()
                      ->label('Application Deadline'),
                  ]),
              ])
              ->collapsible()
              ->collapsed(),

            Section::make('Timestamps')
              ->schema([
                Grid::make(4)
                  ->schema([
                    Placeholder::make('published_at')
                      ->dateTime()
                      ->label('Published At'),

                    Placeholder::make('created_at')
                      ->dateTime()
                      ->label('Created At'),

                    Placeholder::make('updated_at')
                      ->dateTime()
                      ->label('Last Updated'),

                    Placeholder::make('deleted_at')
                      ->dateTime()
                      ->label('Deleted At'),
                  ]),
              ])
              ->collapsible()
              ->collapsed(),
          ]),

        EditAction::make(),
      ])
      ->bulkActions([
        BulkActionGroup::make([
          DeleteBulkAction::make(),
          RestoreBulkAction::make(),
          ForceDeleteBulkAction::make(),
        ]),
      ])
      ->defaultSort('created_at', 'desc');
  }
}