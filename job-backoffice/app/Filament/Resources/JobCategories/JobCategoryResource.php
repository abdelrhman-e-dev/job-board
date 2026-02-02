<?php

namespace App\Filament\Resources\JobCategories;

use App\Filament\Resources\JobCategories\Pages\CreateJobCategory;
use App\Filament\Resources\JobCategories\Pages\EditJobCategory;
use App\Filament\Resources\JobCategories\Pages\ListJobCategories;
use App\Filament\Resources\JobCategories\Schemas\JobCategoryForm;
use App\Filament\Resources\JobCategories\Tables\JobCategoriesTable;
use App\Models\JobCategory;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use UnitEnum;

class JobCategoryResource extends Resource
{
  protected static ?string $model = JobCategory::class;

  protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedRectangleStack;

  protected static ?string $recordTitleAttribute = 'Job Categoreis';

  protected static string|UnitEnum|null $navigationGroup = "Jobs Management";
  protected static ?int $navigationSort = 3;

  public static function form(Schema $schema): Schema
  {
    return JobCategoryForm::configure($schema);
  }

  public static function table(Table $table): Table
  {
    return JobCategoriesTable::configure($table);
  }

  public static function getRelations(): array
  {
    return [
      //
    ];
  }

  public static function getPages(): array
  {
    return [
      'index' => ListJobCategories::route('/'),
      'create' => CreateJobCategory::route('/create'),
      'edit' => EditJobCategory::route('/{record}/edit'),
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
