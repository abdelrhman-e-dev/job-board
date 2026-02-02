<?php

namespace App\Filament\Resources\SystemSettings\Schemas;

use App\Models\SystemSetting;
use Closure;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\KeyValue;
use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Schema;
use Filament\Schemas\Components\Utilities\Set;
use Filament\Schemas\Components\Utilities\Get;

class SystemSettingForm
{
  public static function configure(Schema $schema): Schema
  {
    return $schema
      ->components([
        TextInput::make('key')
          ->label('Setting Key')
          ->unique(ignoreRecord: true)
          ->maxLength(255)
          ->helperText('Unique identifier (e.g.. site_name, mail_host)')
          ->disabled(fn(?SystemSetting $record) => $record !== null)
          ->required(),
        Select::make('group')
          ->label('Group')
          ->options([
            'general' => 'General',
            'email' => 'Email',
            'payment' => 'Payment',
            'security' => 'Security',
            'seo' => 'SEO',
            'social' => 'Social Media',
            'features' => 'Features',
            'limits' => 'Limits',
            'appearance' => 'Appearance',
          ])
          ->searchable()
          ->required(),
        Select::make('type')
          ->label('Value Type')
          ->options([
            'string' => 'String (Text)',
            'text' => 'Text (Long)',
            'integer' => 'Integer (Number)',
            'boolean' => 'Boolean (Yes/No)',
            'json' => 'JSON (Array)',
            'file' => 'File',
            'image' => 'Image',
          ])
          ->live()
          ->afterStateUpdated(fn(Set $set) => $set('Value', null))
          ->required(),
        Textarea::make('value')
          ->label('Value')
          ->maxLength(255)
          ->visible(fn(Get $get) => $get('type') === 'string')
          ->default(null)
          ->columnSpanFull(),
        Textarea::make('value')
          ->label('Value')
          ->rows(5)
          ->visible(fn(Get $get) => $get('type') === 'text'),
        TextInput::make('value')
          ->label('Value')
          ->numeric()
          ->visible(fn(Get $get) => $get('type') === 'integer'),

        // Boolean (Toggle)
        Toggle::make('value')
          ->label('Enabled')
          ->onColor('success')
          ->offColor('danger')
          ->visible(fn(Get $get) => $get('type') === 'boolean')
          ->afterStateHydrated(function (Toggle $component, $state) {
            // Convert string to boolean for display
            $component->state((bool) $state);
          })
          ->dehydrateStateUsing(fn($state) => $state ? '1' : '0'), // Convert boolean to string for storage
        // File Upload
        FileUpload::make('value')
          ->label('File')
          ->directory('settings/files')
          ->visible(fn(Get $get) => $get('type') === 'file'),

        // Image Upload
        FileUpload::make('value')
          ->label('Image')
          ->image()
          ->directory('settings/images')
          ->imageEditor()
          ->visible(fn(Get $get) => $get('type') === 'image'),

        Textarea::make('description')
          ->label('Description')
          ->rows(3)
          ->helperText('Explain what this setting does')
          ->columnSpanFull(),
        Toggle::make('is_public')
          ->label('Public')
          ->helperText('Can this setting be accessed publicly?')
          ->default(false),
      ]);
  }
}
