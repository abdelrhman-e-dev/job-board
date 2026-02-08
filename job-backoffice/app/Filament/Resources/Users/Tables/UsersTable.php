<?php

namespace App\Filament\Resources\Users\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Actions\ForceDeleteBulkAction;
use Filament\Actions\RestoreBulkAction;
use Filament\Actions\ViewAction;
use Filament\Forms\Components\Placeholder;
use Filament\Schemas\Components\Grid;
use Filament\Schemas\Components\Section;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Filters\TrashedFilter;
use Filament\Tables\Table;
use Illuminate\Support\HtmlString;

class UsersTable
{
  public static function configure(Table $table): Table
  {
    return $table
      ->columns([
        ImageColumn::make('avatar')
          ->visibility('public')
          ->circular()
          ->defaultImageUrl('https://png.pngtree.com/png-vector/20220719/ourmid/pngtree-color-icon---businessman-icon-color-sign-vectorteamwork-account-admin-photo-image_37961448.jpg'),
        TextColumn::make('full_name')
          ->label('Full Name')
          ->searchable(query: function ($query, $search) {
            $query->where(function ($q) use ($search) {
              $q->where('first_name', 'like', "%{$search}%")
                ->orWhere('last_name', 'like', "%{$search}%");
            });
          })
          ->getStateUsing(fn($record) => $record->full_name),
        TextColumn::make('email')
          ->label('Email address')
          ->limit(10)
          ->searchable(),
        TextColumn::make('role')
          ->badge()
          ->color(
            fn(string $state): string => match ($state) {
              'system-admin' => 'danger',
              'company-owner' => 'info',
              'hiring-manager' => 'info',
              'recruiter' => 'gray',
              'job-seeker' => 'warning',
              default => 'gray',
            }
          ),
        TextColumn::make('company.name')
          ->label('Company')
          ->sortable()
          ->placeholder('—'),
        TextColumn::make('phone')
          ->searchable(),
        TextColumn::make('country')
          ->searchable(),
        TextColumn::make('deleted_at')
          ->dateTime()
          ->sortable()
          ->toggleable(isToggledHiddenByDefault: true),
        TextColumn::make('created_at')
          ->dateTime('M d')
          ->sortable(),
        TextColumn::make('created_at')
          ->dateTime('M d')
          ->sortable(),
      ])
      ->filters([
        SelectFilter::make('role')
          ->options([
            'system-admin' => 'System Admin',
            'company-owner' => 'Company Owner',
            'hiring-manager' => 'Hiring Manager',
            'recruiter' => 'Recruiter',
            'job-seeker' => 'Job Seeker',
          ]),
        TrashedFilter::make(),
      ])
      ->actions([
        ViewAction::make()
          ->modalHeading(fn($record) => $record->full_name)
          ->modalWidth('7xl')
          ->form([
            Section::make('User Information')
              ->schema([
                Grid::make(4)
                  ->schema([
                    Placeholder::make('full_name')
                      ->label('Full Name')
                      ->content(fn($record) => $record->full_name),
                    Placeholder::make('email')
                      ->label('Email')
                      ->content(fn($record) => $record->email),
                    Placeholder::make('phone')
                      ->label('Phone')
                      ->content(fn($record) => $record->phone),
                    Placeholder::make('country')
                      ->label('Country')
                      ->content(fn($record) => $record->country),
                  ]),
              ])
              ->collapsible(),
            Section::make('Company Information')
              ->schema([
                Grid::make(4)
                  ->schema([
                    Placeholder::make('company')
                      ->label('Company')
                      ->content(function ($record) {
                        if ($record->company_id) {
                          return $record->company->name;
                        } else {
                          return 'Not Assigned Yet';
                        }
                      }),
                  ]),
              ])
              ->collapsible()
              ->collapsed(),
            Section::make('User Applications')
              ->schema([
                Grid::make(1)
                  ->schema([
                    Placeholder::make('total_applications')
                      ->label('Total Applications')
                      ->content(function ($record) {
                        return $record->application()->count();
                      }),
                    Placeholder::make('Applications')
                      ->label('Applications')
                      ->content(function ($record) {
                        $applications = $record->application()->with('jobSeeker')->get();
                        return new HtmlString(
                          collect($applications)->map(function ($app) {
                            return $app->jobSeeker
                              ? $app->jobSeeker->first_name . ' ' . $app->jobSeeker->last_name
                              : 'Unknown Job Seeker';

                          })->implode('<br>')
                        );
                      }),
                  ])
              ])
          ]),
        EditAction::make(),
      ])
      ->toolbarActions([
        BulkActionGroup::make([
          DeleteBulkAction::make(),
          ForceDeleteBulkAction::make(),
          RestoreBulkAction::make(),
        ]),
      ]);
  }
}
