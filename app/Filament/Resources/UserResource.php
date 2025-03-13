<?php

namespace App\Filament\Resources;

use App\Filament\Resources\UserResource\Pages;
use App\Models\User;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Support\Facades\Hash;
use Filament\Infolists;
use Filament\Infolists\Infolist;
use Filament\Support\Enums\FontWeight;

class UserResource extends Resource
{
    protected static ?string $model = User::class;

    protected static ?string $navigationIcon = 'heroicon-o-user-circle';
    protected static ?string $navigationGroup = 'User Management';
    protected static ?int $navigationSort = 1;
    protected static ?string $recordTitleAttribute = 'name';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Section::make('User Information')
                    ->description('Basic user information')
                    ->icon('heroicon-o-user')
                    ->columns(['md' => 2])
                    ->schema([
                        Forms\Components\TextInput::make('name')
                            ->label('Full Name')
                            ->required()
                            ->placeholder('Enter full name')
                            ->maxLength(255)
                            ->columnSpan(['md' => 1]),

                        Forms\Components\TextInput::make('email')
                            ->label('Email Address')
                            ->email()
                            ->required()
                            ->placeholder('email@example.com')
                            ->maxLength(255)
                            ->unique(ignoreRecord: true)
                            ->columnSpan(['md' => 1]),
                    ]),

                // For create form: styled password section
                Forms\Components\Section::make('Set Password')
                    ->description('Create a secure password for this user')
                    ->icon('heroicon-o-key')
                    ->columns(['md' => 2])
                    ->schema([
                        Forms\Components\TextInput::make('password')
                            ->label('Password')
                            ->password()
                            ->required()
                            ->rule('min:8')
                            ->helperText('Minimum 8 characters')
                            ->dehydrateStateUsing(fn (string $state): string => Hash::make($state))
                            ->columnSpan(['md' => 1]),

                        Forms\Components\TextInput::make('password_confirmation')
                            ->label('Confirm Password')
                            ->password()
                            ->required()
                            ->same('password')
                            ->dehydrated(false)
                            ->columnSpan(['md' => 1]),
                    ])
                    ->visible(fn (string $operation): bool => $operation === 'create'),

                // For edit form: enhanced password update section
                Forms\Components\Section::make('Password Management')
                    ->description('Update the user\'s password (optional)')
                    ->icon('heroicon-o-lock-closed')
                    ->schema([
                        Forms\Components\Grid::make(['md' => 2])
                            ->schema([
                                Forms\Components\Toggle::make('update_password')
                                    ->label('Change Password')
                                    ->helperText('Enable to update the user\'s password')
                                    ->default(false)
                                    ->dehydrated(false)
                                    ->live()
                                    ->inline(false)
                                    ->columnSpan(['md' => 2]),
                            ]),

                        Forms\Components\Grid::make(['md' => 2])
                            ->schema([
                                Forms\Components\TextInput::make('password')
                                    ->label('New Password')
                                    ->password()
                                    ->rule('min:8')
                                    ->helperText('Minimum 8 characters')
                                    ->visible(fn (Forms\Get $get): bool => $get('update_password') === true)
                                    ->required(fn (Forms\Get $get): bool => $get('update_password') === true)
                                    ->dehydrateStateUsing(fn (string $state): string => Hash::make($state))
                                    ->dehydrated(fn (Forms\Get $get): bool => $get('update_password') === true)
                                    ->columnSpan(['md' => 1]),

                                Forms\Components\TextInput::make('password_confirmation')
                                    ->label('Confirm New Password')
                                    ->password()
                                    ->visible(fn (Forms\Get $get): bool => $get('update_password') === true)
                                    ->required(fn (Forms\Get $get): bool => $get('update_password') === true)
                                    ->same('password')
                                    ->dehydrated(false)
                                    ->columnSpan(['md' => 1]),
                            ])
                            ->visible(fn (Forms\Get $get): bool => $get('update_password') === true),
                    ])
                    ->visible(fn (string $operation): bool => $operation === 'edit')
                    ->collapsible(),

                Forms\Components\Section::make('Account Status')
                    ->description('User verification information')
                    ->icon('heroicon-o-shield-check')
                    ->schema([
                        Forms\Components\Placeholder::make('email_verified_at')
                            ->label('Email Verified')
                            ->content(fn (?User $record): string => $record && $record->email_verified_at
                                ? 'Verified on ' . $record->email_verified_at->format('M d, Y H:i')
                                : 'Not verified')
                            ->visible(fn (string $operation): bool => $operation === 'edit'),

                        Forms\Components\Placeholder::make('created_at')
                            ->label('Created')
                            ->content(fn (?User $record): string => $record
                                ? $record->created_at->format('M d, Y H:i')
                                : '-')
                            ->visible(fn (string $operation): bool => $operation === 'edit'),

                        Forms\Components\Placeholder::make('updated_at')
                            ->label('Last Updated')
                            ->content(fn (?User $record): string => $record
                                ? $record->updated_at->format('M d, Y H:i')
                                : '-')
                            ->visible(fn (string $operation): bool => $operation === 'edit'),
                    ])
                    ->visible(fn (string $operation): bool => $operation === 'edit')
                    ->collapsed(),
            ])
            ->columns(1);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('name')
                    ->searchable()
                    ->sortable()
                    ->weight(FontWeight::Bold),

                Tables\Columns\TextColumn::make('email')
                    ->icon('heroicon-m-envelope')
                    ->searchable()
                    ->sortable()
                    ->copyable()
                    ->copyMessage('Email address copied')
                    ->copyMessageDuration(1500),

                Tables\Columns\IconColumn::make('email_verified_at')
                    ->label('Verified')
                    ->boolean()
                    ->trueIcon('heroicon-o-check-badge')
                    ->falseIcon('heroicon-o-x-mark')
                    ->trueColor('success')
                    ->falseColor('danger')
                    ->sortable(),

                Tables\Columns\TextColumn::make('created_at')
                    ->label('Created')
                    ->dateTime('M d, Y')
                    ->sortable()
                    ->toggleable(),

                Tables\Columns\TextColumn::make('updated_at')
                    ->label('Updated')
                    ->dateTime('M d, Y')
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                Tables\Filters\Filter::make('verified')
                    ->label('Email Verified')
                    ->query(fn ($query) => $query->whereNotNull('email_verified_at'))
                    ->toggle(),

                Tables\Filters\Filter::make('unverified')
                    ->label('Email Not Verified')
                    ->query(fn ($query) => $query->whereNull('email_verified_at'))
                    ->toggle(),
            ])
            ->actions([
                Tables\Actions\ViewAction::make()
                    ->color('gray'),
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ])
            ->emptyStateActions([
                Tables\Actions\CreateAction::make()
                    ->label('Create User')
                    ->icon('heroicon-m-user-plus'),
            ]);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListUsers::route('/'),
            'create' => Pages\CreateUser::route('/create'),
            'view' => Pages\ViewUser::route('/{record}'),
            'edit' => Pages\EditUser::route('/{record}/edit'),
        ];
    }

    public static function infolist(Infolist $infolist): Infolist
    {
        return $infolist
            ->schema([
                Infolists\Components\Section::make('User Information')
                    ->schema([
                        Infolists\Components\TextEntry::make('name')
                            ->label('Full Name'),
                        Infolists\Components\TextEntry::make('email')
                            ->label('Email Address')
                            ->copyable(),
                        Infolists\Components\TextEntry::make('email_verified_at')
                            ->label('Email Verification')
                            ->formatStateUsing(fn ($state) => $state ? 'Verified on ' . date('M d, Y H:i', strtotime($state)) : 'Not verified')
                            ->icon(fn ($state) => $state ? 'heroicon-o-check-badge' : 'heroicon-o-x-mark')
                            ->color(fn ($state) => $state ? 'success' : 'danger'),
                    ])
                    ->columns(2),

                Infolists\Components\Section::make('Account Details')
                    ->schema([
                        Infolists\Components\TextEntry::make('created_at')
                            ->label('Created At')
                            ->dateTime('M d, Y H:i'),
                        Infolists\Components\TextEntry::make('updated_at')
                            ->label('Last Updated')
                            ->dateTime('M d, Y H:i'),
                    ])
                    ->columns(2),
            ]);
    }
}
