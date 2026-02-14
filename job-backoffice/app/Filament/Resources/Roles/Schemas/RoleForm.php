<?php

namespace App\Filament\Resources\Roles\Schemas;

use Filament\Forms\Components\TextInput;
use Illuminate\Support\Str;
use Filament\Schemas\Components\Utilities\Set;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;



class RoleForm
{
  public static function configure(Schema $schema): Schema
  {
    return $schema
      ->components([
        Section::make('Role Information')
          ->description('Define the basic identifying information for this role.')
          ->icon('heroicon-m-shield-check')
          ->schema([
            TextInput::make('role_name')
              ->unique(ignoreRecord: true)
              ->label('Role Name')
              ->placeholder('e.g. system-admin')
              ->required()
              ->maxLength(255)
              ->columnSpanFull()
              ->prefixIcon('heroicon-m-user-group')
              ->afterStateUpdated(fn(Set $set, ?string $state) => $set('role_name', Str::slug($state))),
          ])
          ->columnSpanFull(),
          ]);
  }
}
