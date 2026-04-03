<?php

namespace App\Filament\Resources\JobVacancies\Widgets;

use App\Models\JobVacancy;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Filament\Widgets\TableWidget as BaseWidget;

class ExpiringJobsTable extends BaseWidget
{

  protected int|string|array $columnSpan = 'full';

  public function table(Table $table): Table
  {
    return $table
      ->query(
        JobVacancy::query()
          ->where('deadline', '>=', now())
          ->where('deadline', '<=', now()->addDays(14))
          ->latest('deadline')
      )
      ->heading('Deadlines Dashboard (Expiring in 14 days)')
      ->columns([

        TextColumn::make('title')
          ->searchable()
          ->sortable()
          ->label('Job Title'),
        TextColumn::make('company.name')
          ->searchable()
          ->sortable()
          ->label('Company'),
        TextColumn::make('deadline')
          ->date()
          ->sortable()
          ->color('danger'),
        TextColumn::make('status')
          ->badge(),
      ])
      ->paginated(false);
  }
}
