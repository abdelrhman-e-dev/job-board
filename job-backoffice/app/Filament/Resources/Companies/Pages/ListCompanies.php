<?php

namespace App\Filament\Resources\Companies\Pages;


use App\Filament\Resources\Companies\CompanyResource;
use App\Filament\Resources\Companies\Widgets\CompaniesByIndustryChart;
use App\Filament\Resources\Companies\Widgets\CompanyGrowthChart;
use App\Filament\Resources\Companies\Widgets\CompanyStatsOverview;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListCompanies extends ListRecords
{
  protected static string $resource = CompanyResource::class;

  protected function getHeaderActions(): array
  {
    return [
      CreateAction::make(),
    ];
  }

  protected function getHeaderWidgets(): array
  {
    return [
      CompanyStatsOverview::class,
      CompaniesByIndustryChart::class,
      CompanyGrowthChart::class,
    ];
  }
}
