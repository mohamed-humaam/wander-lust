<?php

namespace App\Filament\Resources;

use App\Filament\Resources\UserResource\Pages;
//use App\Filament\Resources\UserResource\RelationManagers;
use App\Models\User;
use Filament\Forms;
use Filament\Forms\Components\Placeholder;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Support\Facades\Hash;
//use Illuminate\Database\Eloquent\Builder;
//use Illuminate\Database\Eloquent\SoftDeletingScope;

class UserResource extends Resource
{
    protected static ?string $model = User::class;

    protected static ?int $navigationSort = 12;

    protected static ?string $navigationGroup = 'Settings';

    protected static ?string $navigationIcon = 'heroicon-o-users';

    public static function form(Forms\Form $form): Forms\Form
    {
        return $form
            ->schema([
                Section::make('User Information')
                    ->description('Manage user details like name, email, and authentication settings.')
                    ->schema([
                        TextInput::make('name')
                            ->label('Full Name')
                            ->placeholder('Enter user’s full name')
                            ->helperText('The user’s real name as it should appear in the system.')
                            ->required()
                            ->maxLength(255),

                        TextInput::make('email')
                            ->label('Email Address')
                            ->placeholder('Enter email')
                            ->helperText('This will be used for authentication.')
                            ->required()
                            ->email()
                            ->unique(User::class, 'email', ignoreRecord: true),
                    ])
                    ->columns(2),

                Section::make('Password Settings')
                    ->description('Set a new password when creating a user or update an existing user’s password.')
                    ->schema([
                        Placeholder::make('password_note')
                            ->content('For security, users must have a strong password.'),

                        Toggle::make('update_password')
                            ->label('Update Password')
                            ->helperText('Enable this to update the user’s password.')
                            ->hidden(fn ($livewire) => $livewire instanceof Pages\CreateUser)
                            ->live(),

                        TextInput::make('password')
                            ->label('New Password')
                            ->placeholder('Enter new password')
                            ->helperText('Use at least 8 characters, including numbers and special symbols.')
                            ->password()
                            ->revealable()
                            ->maxLength(255)
                            ->required(fn ($get) => $get('update_password') === true || request()->routeIs('filament.admin.resources.users.create'))
                            ->hidden(fn ($get) => !$get('update_password') && !request()->routeIs('filament.admin.resources.users.create')),

                        TextInput::make('password_confirmation')
                            ->label('Confirm Password')
                            ->placeholder('Re-enter password')
                            ->helperText('Must match the new password.')
                            ->password()
                            ->revealable()
                            ->same('password')
                            ->maxLength(255)
                            ->required(fn ($get) => $get('update_password') === true)
                            ->hidden(fn ($get) => !$get('update_password')),
                    ])
                    ->columns(2)
                    ->collapsible(),
            ]);
    }

    public static function table(Tables\Table $table): Tables\Table
    {
        return $table
            ->columns([
                TextColumn::make('name')
                    ->sortable()
                    ->searchable(),

                TextColumn::make('email')
                    ->sortable()
                    ->searchable(),

                TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable(),

                TextColumn::make('updated_at')
                    ->dateTime()
                    ->sortable(),
            ])
            ->filters([])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
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
            'edit' => Pages\EditUser::route('/{record}/edit'),
        ];
    }
}
