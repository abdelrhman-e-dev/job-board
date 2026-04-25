<?php

namespace App\Filament\Resources\Applications\Schemas;

use App\Models\Application;
use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\Hidden;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;

class ApplicationForm
{
  public static function configure(Schema $schema): Schema
  {
    return $schema
      ->components([
        Section::make('Status')
          ->description('Update application status')
          ->schema([
            Select::make('status')
              ->label('Status')
              ->options(Application::STATUS_OPTIONS)
              ->required()
              ->live()
              ->afterStateUpdated(function ($state, $set, $record) {
                  if ($record && $state !== $record->getOriginal('status')) {
                      $set('status_history', $record->appendStatusHistory($state));
                  }
              })
              ->columnSpanFull(),
            Hidden::make('status_history'),
          ])
          ->columns(1),
        Section::make('Priotiry')
          ->description('Update application priority')
          ->schema([
            Select::make('priority')
              ->label('Priority')
              ->options(Application::PRIORITY_OPTIONS)
              ->required()
              ->live()
              ->columnSpanFull(),
          ])
          ->columns(1),
        Section::make('Flagged')
          ->description('Update application flagged')
          ->schema([
            Toggle::make('is_flagged')
              ->label('Flagged')
              ->required()
              ->live()
              ->columnSpanFull(),
          ])
          ->columns(1),
      ]);
  }
}
