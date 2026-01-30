<?php

namespace App\Filament\Resources\JobVacancies\Schemas;

use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Schemas\Schema;

class JobVacancyForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('company_id')
                    ->required(),
                TextInput::make('category_id')
                    ->default(null),
                TextInput::make('posted_by')
                    ->required(),
                TextInput::make('title')
                    ->required(),
                TextInput::make('slug')
                    ->required(),
                Textarea::make('description')
                    ->required()
                    ->columnSpanFull(),
                Textarea::make('requirements')
                    ->required()
                    ->columnSpanFull(),
                Select::make('type')
                    ->options([
            'full-time' => 'Full time',
            'part-time' => 'Part time',
            'contract' => 'Contract',
            'internship' => 'Internship',
            'remote' => 'Remote',
            'hybrid' => 'Hybrid',
        ])
                    ->required(),
                Select::make('level')
                    ->options([
            'entry' => 'Entry',
            'mid' => 'Mid',
            'senior' => 'Senior',
            'lead' => 'Lead',
            'manager' => 'Manager',
        ])
                    ->required(),
                TextInput::make('location')
                    ->required(),
                TextInput::make('salary_min')
                    ->numeric()
                    ->default(null),
                TextInput::make('salary_max')
                    ->numeric()
                    ->default(null),
                TextInput::make('salary_currency')
                    ->default(null),
                Textarea::make('screening_questions')
                    ->default(null)
                    ->columnSpanFull(),
                Select::make('status')
                    ->options(['draft' => 'Draft', 'active' => 'Active', 'closed' => 'Closed', 'expired' => 'Expired'])
                    ->default('draft')
                    ->required(),
                TextInput::make('views_count')
                    ->required()
                    ->numeric()
                    ->default(0),
                TextInput::make('applications_count')
                    ->required()
                    ->numeric()
                    ->default(0),
                DateTimePicker::make('deadline'),
                DateTimePicker::make('published_at'),
            ]);
    }
}
