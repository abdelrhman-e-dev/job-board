<?php

namespace App\Filament\Resources\JobVacancies\Schemas;

use App\Models\Company;
use App\Models\JobCategory;
use App\Models\JobVacancy;
use App\Models\User;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\RichEditor\ToolbarButtonGroup;
use Filament\Forms\Components\KeyValue;
use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Components\Utilities\Get;
use Filament\Schemas\Schema;
use Illuminate\Support\Str;

class JobVacancyForm
{
  public static function configure(Schema $schema): Schema
  {
    return $schema
      ->components([

        // ─── Basic Info ───────────────────────────────────────────────
        Section::make('Basic Information')
          ->icon('heroicon-o-briefcase')
          ->columns(2)
          ->schema([
            TextInput::make('title')
              ->label('hadeer hassan')
              ->unique(ignoreRecord: true)
              ->live(onBlur: true)
              ->afterStateUpdated(function ($state, callable $set) {
                $set('slug', Str::slug($state));
              })
              ->required()
              ->columnSpan(1),
            TextInput::make('slug')
              ->label('Slug')
              ->readOnly()
              ->required()
              ->columnSpan(1),
            Select::make('company_id')
              ->label('Company')
              ->options(Company::all()->pluck('name', 'company_id'))
              ->searchable()
              ->required()
              ->columnSpan(1),
            Select::make('category_id')
              ->label('Category')
              ->options(JobCategory::all()->pluck('name', 'category_id'))
              ->searchable()
              ->required()
              ->columnSpan(1),
            Select::make('posted_by')
              ->label('Posted By')
              ->options(
                User::all()->mapWithKeys(fn($user) => [$user->user_id => "{$user->first_name} {$user->last_name}"])
              )
              ->searchable()
              ->required()
              ->columnSpanFull(),
          ])->columnSpanFull(),

        // ─── Location ─────────────────────────────────────────────────
        Section::make('Location')
          ->icon('heroicon-o-map-pin')
          ->columns(2)
          ->schema([
            Select::make('location')
              ->label('Location Type')
              ->options(JobVacancy::LOCATION_TYPE_OPTIONS)
              ->required(),
            TextInput::make('city')
              ->label('City')
              ->required(),
            TextInput::make('address')
              ->label('Address')
              ->required(),
          ]),

        // ─── Compensation ─────────────────────────────────────────────
        Section::make('Compensation')
          ->icon('heroicon-o-banknotes')
          ->columns(2)
          ->schema([
            TextInput::make('salary_min')
              ->label('Salary Min')
              ->numeric()
              ->minValue(0)
              ->live(onBlur: true)
              ->required(),
            TextInput::make('salary_max')
              ->label('Salary Max')
              ->numeric()
              ->minValue(fn(Get $get) => $get('salary_min') ?? 0)
              ->required(),
            Select::make('salary_currency')
              ->label('Currency')
              ->options(JobVacancy::CURRENCY_OPTIONS)
              ->required(),
          ]),
        // ─── Job Details ──────────────────────────────────────────────
        Section::make('Job Details')
          ->icon('heroicon-o-document-text')
          ->schema([
            RichEditor::make('description')
              ->label('Description')
              ->json()
              ->toolbarButtons([
                'bold',
                'italic',
                'underline',
                'bulletList',
                'orderedList',
                'h2',
                'h3',
              ])
              ->required(),
            RichEditor::make('requirements')
              ->label('Requirements')
              ->json()
              ->toolbarButtons([
                'bold',
                'italic',
                'underline',
                'bulletList',
                'orderedList',
                'h2',
                'h3',
              ])
              ->required(),
            KeyValue::make('screening_questions')
              ->label('Screening Questions')
              ->keyLabel('Question')
              ->valueLabel('Answer'),
            Select::make('required_documents')
              ->label('Required Documents')
              ->options(JobVacancy::REQUIRED_DOCUMENTS_OPTIONS)
              ->multiple(),
          ])->columnSpanFull(),

        // ─── Classification ───────────────────────────────────────────
        Section::make('Classification')
          ->icon('heroicon-o-tag')
          ->columns(2)
          ->schema([
            Select::make('type')
              ->label('Type')
              ->options(JobVacancy::TYPE_OPTIONS)
              ->required(),
            Select::make('level')
              ->label('Level')
              ->options(JobVacancy::LEVEL_OPTIONS)
              ->required(),
            TextInput::make('education')
              ->label('Education')
              ->required(),
            TextInput::make('experience_years')
              ->label('Experience (Years)')
              ->numeric()
              ->minValue(0)
              ->required(),
          ]),

        // ─── Publishing ───────────────────────────────────────────────
        Section::make('Publishing')
          ->icon('heroicon-o-cog-6-tooth')
          ->columns(2)
          ->schema([
            Select::make('status')
              ->label('Status')
              ->options(JobVacancy::STATUS_OPTIONS_FOR_ADMIN)
              ->required(),
            Select::make('visibility')
              ->label('Visibility')
              ->options(JobVacancy::VISIBILITY_OPTIONS)
              ->required(),
            DatePicker::make('deadline')
              ->label('Deadline')
              ->minDate(now())
              ->required(),
            Toggle::make('is_featured')
              ->label('Featured Listing')
              ->inline(false),
          ]),

      ]);
  }
}
