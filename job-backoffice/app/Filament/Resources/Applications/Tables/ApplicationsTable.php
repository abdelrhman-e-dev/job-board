<?php

namespace App\Filament\Resources\Applications\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Actions\ForceDeleteBulkAction;
use Filament\Actions\RestoreBulkAction;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\TrashedFilter;
use Filament\Tables\Table;

class ApplicationsTable
{
  public static function configure(Table $table): Table
  {
    return $table
      ->columns([
        TextColumn::make('jobSeeker.name')
          ->label("Applicant Name")
          ->searchable()
          ->sortable(),
        TextColumn::make('job.title')
          ->label("Job Title")
          ->searchable()
          ->sortable(),
        TextColumn::make('company.name')
          ->label("Company Name")
          ->searchable()
          ->sortable(),
        TextColumn::make('status')
          ->badge()
          ->color(fn($state): string => match ($state) {
            'new' => 'primary',
            'reviewing' => 'info',
            'shortlisted' => 'warning',
            'interview' => 'warning',
            'offer' => 'info',
            'hired' => 'success',
            'rejected' => 'danger',
            'withdraw' => 'gray',
          })
          ->label("Status")
          ->searchable()
          ->sortable(),
        TextColumn::make('aiGeneratedScore')
          ->label("AI Score")
          ->suffix("%")
          ->searchable()
          ->sortable(),
        IconColumn::make('is_read')
          ->boolean()
          ->label("Read")
          ->searchable()
          ->sortable(),
        TextColumn::make('created_at')
          ->label("Applied At")
          ->date('d, M Y')
          ->searchable()
          ->sortable(),
      ])
      ->filters([
        TrashedFilter::make(),
      ])
      ->recordActions([
        EditAction::make(),
      ])
      ->toolbarActions([
        BulkActionGroup::make([
          DeleteBulkAction::make(),
          ForceDeleteBulkAction::make(),
          RestoreBulkAction::make(),
        ]),
      ]);
  }
}
