<?php

namespace App\Filament\Resources\Companies;

use App\Filament\Resources\Companies\Pages\CreateCompany;
use App\Filament\Resources\Companies\Pages\EditCompany;
use App\Filament\Resources\Companies\Pages\ListCompanies;
use App\Filament\Resources\Companies\Schemas\CompanyForm;
use App\Filament\Resources\Companies\Tables\CompaniesTable;
use App\Models\Company;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use UnitEnum;

class CompanyResource extends Resource
{
  protected static ?string $model = Company::class;

  protected static string|BackedEnum|null $navigationIcon = Heroicon::BuildingOffice2;

  protected static ?string $recordTitleAttribute = 'Company';
  protected static string | UnitEnum | null $navigationGroup = "Compnaies Management";
  protected static ?int $navigationSort = 1;

  public static function form(Schema $schema): Schema
  {
    return CompanyForm::configure($schema);
  }

  public static function table(Table $table): Table
  {
    return CompaniesTable::configure($table);
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
      'index' => ListCompanies::route('/'),
      'create' => CreateCompany::route('/create'),
      'edit' => EditCompany::route('/{record}/edit'),
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
