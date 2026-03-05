<?php

namespace App\Filament\Resources\Companies\Schemas;

use App\Models\Company;
use App\Models\User;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\KeyValue;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Components\Utilities\Set;
use Filament\Schemas\Schema;
use Illuminate\Support\Carbon;
use Illuminate\Support\Str;

class CompanyForm
{
  public static function configure(Schema $schema): Schema
  {
    return $schema
      ->components([
        // ── SECTION 1: Identity ──────────────────────────────────────────
        Section::make('Company Identity')
          ->description('Basic information that identifies the company.')
          ->icon('heroicon-o-building-office')
          ->columns(2)
          ->schema([
            TextInput::make('name')
              ->label('Company Name')
              ->unique(ignoreRecord: true)
              ->prefixIcon('heroicon-o-building-office')
              ->placeholder('e.g. Tech Solutions')
              ->live(onBlur: true)
              ->helperText('The name of the company as it will appear on the website.')
              ->afterStateUpdated(fn(Set $set, ?string $state) => $set('slug', Str::slug($state, '_')))
              ->required(),

            TextInput::make('slug')
              ->label('Slug')
              ->readOnly()
              ->unique(ignoreRecord: true)
              ->prefixIcon('heroicon-o-link')
              ->helperText('Auto-generated from the name.')
              ->placeholder('e.g. tech_solutions')
              ->required(),

            TextInput::make('website')
              ->placeholder('e.g. https://www.google.com')
              ->helperText('The URL of the company website.')
              ->prefixIcon('heroicon-o-globe-alt')
              ->url()
              ->label('Company Website'),

            TextInput::make('contact_phone')
              ->label('Contact Phone')
              ->prefixIcon('heroicon-o-phone')
              ->tel()
              ->required(),

            Textarea::make('description')
              ->helperText('A short description of the company.')
              ->placeholder('e.g. Tech Solutions is a leading provider of software solutions.')
              ->label('Description')
              ->minLength(20)
              ->maxLength(1024)
              ->autosize()
              ->columnSpanFull(),
          ])
          ->columnSpanFull(),



        // ── SECTION 2: Company Profile ───────────────────────────────────
        Section::make('Company Profile')
          ->description('Industry details and company characteristics.')
          ->icon('heroicon-o-briefcase')
          ->columns(2)
          ->schema([
            TextInput::make('industry')
              ->label('Industry')
              ->placeholder('e.g. Technology')
              ->prefixIcon('heroicon-o-cpu-chip')
              ->helperText('Type or select an industry')
              ->datalist(
                Company::query()->whereNotNull('industry')->distinct()->pluck('industry')->toArray()
              )
              ->live(onBlur: true)
              ->afterStateUpdated(fn(Set $set, ?string $state) => $set('industry', Str::ucfirst($state)))
              ->required(),

            TextInput::make('specialization')
              ->label('Specialization')
              ->placeholder('e.g. Software')
              ->prefixIcon('heroicon-o-wrench-screwdriver')
              ->helperText('Type or select a specialization')
              ->datalist(
                Company::query()->whereNotNull('specialization')->distinct()->pluck('specialization')->toArray()
              )
              ->live(onBlur: true)
              ->afterStateUpdated(fn(Set $set, ?string $state) => $set('specialization', Str::ucfirst($state)))
              ->required(),

            TextInput::make('size')
              ->label('Company Size')
              ->placeholder('e.g. 150')
              ->helperText('Total number of employees.')
              ->prefixIcon('heroicon-o-users')
              ->integer()
              ->minValue(1)
              ->required(),
            TextInput::make('founded_year')
              ->label('Founded Year')
              ->placeholder('e.g. 1999')
              ->helperText('The year the company was founded.')
              ->numeric()
              ->maxLength(4)
              ->minValue(1900)
              ->maxValue(date('Y'))
              ->required(),
          ]),
        // ── SECTION 3: Location ──────────────────────────────────────────
        Section::make('Location')
          ->description('Where the company is based.')
          ->icon('heroicon-o-map-pin')
          ->columns(2)
          ->schema([
            TextInput::make('address')
              ->placeholder('e.g. 123 Main St')
              ->helperText('Street address of the company.')
              ->prefixIcon('heroicon-o-home')
              ->label('Street Address')
              ->columnSpan(2),

            TextInput::make('city')
              ->placeholder('e.g. Anytown')
              ->helperText('City.')
              ->prefixIcon('heroicon-o-building-storefront')
              ->required()
              ->label('City'),

            TextInput::make('country')
              ->placeholder('e.g. USA')
              ->helperText('Country.')
              ->prefixIcon('heroicon-o-flag')
              ->required()
              ->label('Country'),
          ]),
        // ── SECTION 4: Media ─────────────────────────────────────────────
        Section::make('Branding & Media')
          ->description('Upload the company logo and banner image.')
          ->icon('heroicon-o-photo')
          ->columns(2)
          ->schema([
            FileUpload::make('logo')
              ->label('Company Logo')
              ->helperText('Recommended: square image (1:1).')
              ->required()
              ->image()
              ->imageEditor()
              ->imageAspectRatio('1:1')
              ->automaticallyOpenImageEditorForAspectRatio()
              ->loadingIndicatorPosition('right')
              ->panelLayout('integrated')
              ->removeUploadedFileButtonPosition('right')
              ->uploadButtonPosition('left')
              ->uploadProgressIndicatorPosition('right')
              ->disk('public')
              ->directory('images/company/logos')
              ->getUploadedFileNameForStorageUsing(
                fn($file) => uniqid() . '_' . $file->getClientOriginalName(),
              ),

            FileUpload::make('banner')
              ->label('Company Banner')
              ->helperText('Recommended: widescreen image (16:9).')
              ->required()
              ->image()
              ->imageEditor()
              ->imageResizeTargetWidth(1200)
              ->imageResizeTargetHeight(675)
              ->imageAspectRatio('16:9')
              ->rules([
                'image',
                'mimes:jpeg,png,jpg,gif,svg,webp',
                'max:2048',
              ])
              ->automaticallyOpenImageEditorForAspectRatio()
              ->loadingIndicatorPosition('right')
              ->panelLayout('integrated')
              ->removeUploadedFileButtonPosition('right')
              ->uploadButtonPosition('left')
              ->uploadProgressIndicatorPosition('right')
              ->disk('public')
              ->directory('images/company/banners')
              ->getUploadedFileNameForStorageUsing(
                fn($file) => uniqid() . '_' . $file->getClientOriginalName(),
              ),
          ])->columnSpanFull(),


        // ── SECTION 5: Social Links ──────────────────────────────────────
        Section::make('Social Media')
          ->description('Add links to the company\'s social media profiles.')
          ->icon('heroicon-o-share')
          ->collapsed()
          ->schema([
            KeyValue::make('social_links')
              ->label('Social Links')
              ->addActionLabel('Add social link')
              ->keyLabel('Platform')
              ->valueLabel('URL')
              ->keyPlaceholder('e.g. Facebook')
              ->valuePlaceholder('e.g. https://www.facebook.com/company')
              ->helperText('Add all relevant social media links for the company.'),
          ]),

        // ── SECTION 6: Admin Settings ────────────────────────────────────
        Section::make('Admin Settings')
          ->description('Internal settings managed by administrators.')
          ->icon('heroicon-o-cog-6-tooth')
          ->columns(2)
          ->collapsed()
          ->schema([
            TextInput::make('job_posting_limit')
              ->label('Job Posting Limit')
              ->placeholder('e.g. 10')
              ->helperText('Max number of active job postings allowed.')
              ->prefixIcon('heroicon-o-document-text')
              ->integer()
              ->minValue(1)
              ->required(),

            Select::make('owner_id')
              ->label('Company Owner')
              ->relationship('users', 'name')
              ->options(
                User::getOwners()->get()->mapWithKeys(fn($user) => [$user->user_id => "{$user->first_name} {$user->last_name}"])

              )
              ->preload()
              ->searchable()
              ->prefixIcon('heroicon-m-user-group')
              ->helperText('Assign a user with the Company Owner role.')
              ->native(false),
          ]),
      ]);
  }
}
