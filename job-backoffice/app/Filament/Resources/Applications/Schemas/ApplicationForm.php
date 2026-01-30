<?php

namespace App\Filament\Resources\Applications\Schemas;

use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Schema;

class ApplicationForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('job_id')
                    ->required(),
                TextInput::make('job_seeker_id')
                    ->required(),
                TextInput::make('document_id')
                    ->required(),
                Textarea::make('cover_letter')
                    ->default(null)
                    ->columnSpanFull(),
                TextInput::make('aiGeneratedScore')
                    ->required()
                    ->numeric()
                    ->default(0),
                Textarea::make('ai_feedback')
                    ->default(null)
                    ->columnSpanFull(),
                Textarea::make('screening_questions')
                    ->default(null)
                    ->columnSpanFull(),
                Select::make('status')
                    ->options([
            'new' => 'New',
            'reviewing' => 'Reviewing',
            'shortlisted' => 'Shortlisted',
            'interview' => 'Interview',
            'offer' => 'Offer',
            'hired' => 'Hired',
            'rejected' => 'Rejected',
            'withdraw' => 'Withdraw',
        ])
                    ->default('new')
                    ->required(),
                TextInput::make('rating')
                    ->numeric()
                    ->default(null),
                Textarea::make('status_history')
                    ->default(null)
                    ->columnSpanFull(),
                Toggle::make('is_read')
                    ->required(),
                DateTimePicker::make('read_at'),
            ]);
    }
}
