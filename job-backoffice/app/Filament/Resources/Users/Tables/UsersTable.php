<?php

namespace App\Filament\Resources\Users\Tables;

use Filament\Actions\Action;
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
        TextColumn::make('status')
          ->label('Status')
          ->badge()
          ->color(
            fn(string $state): string => match ($state) {
              'Active' => 'success',
              'Inactive' => 'danger',
              default => 'gray',
            }
          ) 
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
          ->modalWidth('6xl')
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
              Section::make('Account Information')
              ->schema([
                Grid::make(4)
                  ->schema([
                    Placeholder::make('role')
                      ->label('Role')
                      ->content(fn($record) => $record->role),
                    Placeholder::make('email_verified_at')
                      ->label('Email Verified')
                      ->content(fn($record) => $record->email_verified_at ? 'Yes' : 'No'),
                    Placeholder::make('status')
                      ->label('Status')
                      ->content(fn($record) => $record->status),
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
                      ->content(fn($record) => $record->applications()->count()),
                    Placeholder::make('applications')
                      ->label('Applications List')
                      ->content(function ($record) {
                        $apps = $record->applications()
                          ->with('job.company')
                          ->latest()
                          ->get();

                        if ($apps->isEmpty()) {
                          return 'No applications found.';
                        }
                        $list = $apps->map(function ($app) {
                          $jobTitle = e($app->job->title ?? 'Unknown Job');
                          $company = e($app->job->company->name ?? 'Unknown Company');
                          $status = ucfirst($app->status);
                          return "
                                <li style='margin-bottom: 8px;'>
                                <strong>{$jobTitle}</strong>
                                <div style='font-size: 13px; color: #6b7280;'>
                                {$company} • {$status} • {$app->created_at->format('M d, Y')}
                                </div>
                                </li>
                                  ";
                        })->implode('');

                        return new HtmlString("
                                <ul style='list-style: none; padding-left: 0;'>
                                {$list}
                                </ul>
                          ");
                      }),

                  ])
              ])->collapsible()
              ->collapsed()
          ]),
        EditAction::make(),
        // send verification email acction
        Action::make('sendVerification')
        ->label('Send Verification Email')
        ->icon('heroicon-o-envelope')
        ->color('primary')
        ->requiresConfirmation()
        ->visible(fn($record) => ! $record->hasVerifiedEmail())
        ->action(fn ($record) => $record->sendEmailVerificationNotification())
        ->successNotificationTitle('Verification email sent'),
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
