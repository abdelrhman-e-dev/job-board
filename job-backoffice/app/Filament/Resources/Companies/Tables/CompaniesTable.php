<?php

namespace App\Filament\Resources\Companies\Tables;

use App\Models\Company;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Actions\ForceDeleteBulkAction;
use Filament\Actions\RestoreBulkAction;
use Filament\Actions\ViewAction;
use Filament\Forms\Components\Placeholder;
use Filament\Schemas\Components\Grid;
use Filament\Schemas\Components\Section;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Filters\TrashedFilter;
use Filament\Tables\Table;
use Illuminate\Support\HtmlString;

class CompaniesTable
{
  public static function configure(Table $table): Table
  {
    return $table

      ->columns([
        ImageColumn::make('logo')
          ->circular(),
        TextColumn::make('name')
          ->searchable()
          ->label('Company Name'),
        TextColumn::make('owner.full_name')
          ->label('Owner'),
        TextColumn::make('industry')
          ->label('Industry'),
        TextColumn::make('specialization')
          ->label('Specialization'),
        IconColumn::make('verified')
          ->boolean()
          ->sortable(),
        TextColumn::make('created_at')
          ->label('Jioned At')
          ->dateTime('d, MY')
          ->sortable(),
      ])
      ->filters([
        SelectFilter::make('industry')
          ->options(
            Company::all()->pluck('industry', 'industry')->toArray()
          ),
        SelectFilter::make('industry')
          ->options(
            Company::all()->pluck('industry', 'industry')->toArray()
          ),
        TrashedFilter::make(),
      ])
      ->recordActions([
        ViewAction::make('view company')
          ->modalHeading('Company Details')
          ->modalWidth('7xl')
          ->schema([

            Section::make('Company Overview')
              ->icon('heroicon-o-building-office-2')
              ->columns([
                'sm' => 1,
                'md' => 2,
                'xl' => 4,
              ])
              ->schema([
                Placeholder::make('name')
                  ->label('Company Name')
                  ->content(fn($record) => $record->name)
                  ->extraAttributes(['class' => 'font-semibold text-lg']),

                Placeholder::make('owner')
                  ->label('Owner')
                  ->content(fn($record) => $record->owner?->full_name ?? '-')
                  ->extraAttributes(['class' => 'text-primary-600 font-medium']),

                Placeholder::make('industry')
                  ->label('Industry')
                  ->content(fn($record) => $record->industry ?? '-')
                  ->badge(),
                Placeholder::make('specialization')
                  ->label('Specialization')
                  ->content(fn($record) => $record->specialization ?? '-')
                  ->badge(),
              ]),

            Section::make('Employees')
              ->icon('heroicon-o-users')
              ->schema([

                Section::make('Owner')
                  ->compact()
                  ->schema([
                    Placeholder::make('owner_info')
                      ->hiddenLabel()
                      ->content(
                        fn($record) =>
                        $record->owner
                        ? "{$record->owner->full_name} ({$record->owner->email})"
                        : 'No owner assigned'
                      ),
                  ]),

                Section::make('Hiring Managers')
                  ->compact()
                  ->schema([
                    Placeholder::make('hiring_managers')
                      ->hiddenLabel()
                      ->content(
                        fn($record) =>
                        $record->hiringManagers->isEmpty()
                        ? 'No hiring managers found'
                        : new HtmlString(
                          $record->hiringManagers
                            ->map(fn($m) => "
                                                <div class='py-1'>
                                                    <span class='font-bold'>{$m->full_name}</span>
                                                    <span class='text-red-500'>({$m->email})</span>
                                                    <span class='text-xs text-gray-400 ml-2'>
                                                        since {$m->created_at?->format('M Y')}
                                                    </span>
                                                </div>
                                            ")
                            ->implode('')
                        )
                      ),
                  ]),

                Section::make('Recruiters')
                  ->compact()
                  ->schema([
                    Placeholder::make('recruiters')
                      ->hiddenLabel()
                      ->content(
                        fn($record) =>
                        $record->recruiters->isEmpty()
                        ? 'No recruiters found'
                        : new HtmlString(
                          $record->recruiters
                            ->map(fn($r) => "
                                                <div class='py-1'>
                                                    <span class='font-bold'>{$r->full_name}</span>
                                                    <span class='text-gray-500'>({$r->email})</span>
                                                    <span class='text-xs text-gray-400 ml-2'>
                                                        since {$r->created_at?->format('M Y')}
                                                    </span>
                                                </div>
                                            ")
                            ->implode('')
                        )
                      ),
                  ]),
              ])
              ->collapsible()
              ->collapsed(),
          ]),
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
