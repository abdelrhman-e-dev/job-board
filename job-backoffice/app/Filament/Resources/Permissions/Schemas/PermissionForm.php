<?php

namespace App\Filament\Resources\Permissions\Schemas;

use App\Models\Permission;
use App\Models\Role;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Components\Grid;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;
use Illuminate\Support\Str;
use Filament\Schemas\Components\Utilities\Set;

class PermissionForm
{
  public static function configure(Schema $schema): Schema
  {
    return $schema
      ->components([
        Grid::make(3)
          ->schema([
            Section::make('Permission Information')
              ->description('Define the basic identifying information for this permission.')
              ->icon('heroicon-m-document-text')
              ->schema([
                Grid::make(2)
                  ->schema([
                    TextInput::make('permission_name')
                      ->label('Permission Name')
                      ->required()
                      ->unique(ignoreRecord: true)
                      ->prefixIcon('heroicon-m-key')
                      ->placeholder('e.g. create_user')
                      ->live(onBlur: true)
                      ->afterStateUpdated(fn(Set $set, ?string $state) => $set('permission_name', Str::slug($state, '_')))
                      ->maxLength(255),
                    TextInput::make('group')
                      ->prefixIcon('heroicon-m-tag')
                      ->label('Group')
                      ->placeholder('e.g. jobs, users, applications')
                      ->required()
                      ->maxLength(255),
                  ]),
                TextInput::make('description')
                  ->label('Description')
                  ->placeholder('Write a small description for this permission')
                  ->maxLength(255),
              ])
              ->columnSpan(2),
            Section::make('Configuration')
              ->description('Define the visibility and role assignments.')
              ->icon('heroicon-m-cog-6-tooth')
              ->schema([
                Select::make('visibility')
                  ->label('Visibility')
                  ->prefixIcon('heroicon-m-eye')
                  ->options([
                    'system_only' => 'System only',
                    'company_available' => 'Company available',
                  ])
                  ->required()
                  ->native(false),
                Select::make('roles')
                  ->label('Assign to Roles')
                  ->relationship('roles', 'role_name')
                  ->multiple()
                  ->preload()
                  ->prefixIcon('heroicon-m-user-group')
                  ->required()
                  ->native(false),
              ])
              ->columnSpan(1),
          ])
          ->columnSpanFull(),
      ]);
  }
}
