<?php

namespace App\Filament\Resources\JobCategories\Schemas;

use App\Models\JobCategory;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Components\Grid;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Components\Utilities\Set;
use Filament\Schemas\Schema;
use Illuminate\Support\Str;

class JobCategoryForm
{
  public static function configure(Schema $schema): Schema
  {
    return $schema
      ->components([
        Section::make('Category Details')
          ->description('Basic information about the job category.')
          ->schema([
            Grid::make(2)
              ->schema([
                TextInput::make('name')
                  ->label('Category Name')
                  ->placeholder('e.g. Software Development')
                  ->prefixIcon('heroicon-o-tag')
                  ->unique(JobCategory::class, 'name', ignoreRecord: true)
                  ->live(onBlur: true)
                  ->afterStateUpdated(fn(Set $set, ?string $state) => $set('slug', Str::slug($state)))
                  ->required(),
                TextInput::make('slug')
                  ->label('URL Slug')
                  ->placeholder('software-development')
                  ->prefixIcon('heroicon-o-link')
                  ->unique(JobCategory::class, 'slug', ignoreRecord: true)
                  ->required(),
              ]),
            Select::make('parent_id')
              ->label('Parent Category')
              ->placeholder('Select a parent category')
              ->helperText('Optional: Assign this category to a parent for hierarchical organization.')
              ->prefixIcon('heroicon-o-folder-open')
              ->options(JobCategory::query()->whereNull('parent_id')->pluck('name', 'category_id'))
              ->searchable()
              ->default(null),
          ])->columnSpanFull()
      ]);
  }
}
