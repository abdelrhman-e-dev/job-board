<?php

namespace App\Filament\Resources\JobCategories\Schemas;

use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;

class JobCategoryForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('name')
                    ->required(),
                TextInput::make('slug')
                    ->required(),
                TextInput::make('parent_id')
                    ->default(null),
            ]);
    }
}
