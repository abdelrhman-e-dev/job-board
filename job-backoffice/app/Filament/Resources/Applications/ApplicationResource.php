<?php

namespace App\Filament\Resources\Applications;

use App\Filament\Resources\Applications\Pages\CreateApplication;
use App\Filament\Resources\Applications\Pages\EditApplication;
use App\Filament\Resources\Applications\Pages\ListApplications;
use App\Filament\Resources\Applications\Schemas\ApplicationForm;
use App\Filament\Resources\Applications\Tables\ApplicationsTable;
use App\Models\Application;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use UnitEnum;

class ApplicationResource extends Resource
{
  protected static ?string $model = Application::class;

  protected static string|BackedEnum|null $navigationIcon = Heroicon::Square2Stack;

  protected static ?string $recordTitleAttribute = 'Applications';
  protected static ?string $navigationLabel = "Job Application";
  protected static string|UnitEnum|null $navigationGroup = "Jobs Management";
  protected static ?int $navigationSort = 5;
  public static function form(Schema $schema): Schema
  {
    return ApplicationForm::configure($schema);
  }

  public static function table(Table $table): Table
  {
    return ApplicationsTable::configure($table);
  }

  public static function getRelations(): array
  {
    return [
      //
    ];
  }

  public static function canCreate(): bool
  {
    return false;
  }


  public static function canDelete($record): bool
  {
    return false;
  }

  public static function canDeleteAny(): bool
  {
    return false;
  }
  public static function getPages(): array
  {
    return [
      'index' => ListApplications::route('/'),
      'edit' => EditApplication::route('/{record}/edit'),
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
