<?php

namespace App\Filament\Resources\JobCategories\Pages;

use App\Filament\Resources\JobCategories\JobCategoryResource;
use App\Filament\Resources\JobCategories\Widgets\ApplicationsPerCategory;
use App\Filament\Resources\JobCategories\Widgets\CategoryGrowthTrend;
use App\Filament\Resources\JobCategories\Widgets\JobPostingsPerCategory;
use App\Filament\Resources\JobCategories\Widgets\CategoryStats;
use App\Filament\Resources\JobCategories\Widgets\TrendingCategories;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListJobCategories extends ListRecords
{
  protected static string $resource = JobCategoryResource::class;

  protected function getHeaderActions(): array
  {
    return [
      CreateAction::make(),
    ];
  }
  protected function getHeaderWidgets(): array
  {
    return [
      CategoryStats::class,
      JobPostingsPerCategory::class,
      ApplicationsPerCategory::class,
      TrendingCategories::class,
      CategoryGrowthTrend::class,
    ];
  }
}
