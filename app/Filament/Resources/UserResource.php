<?php

namespace App\Filament\Resources;

use App\Filament\Resources\UserResource\Pages;
use App\Filament\Resources\UserResource\RelationManagers;
use App\Models\User;
use Filament\Forms;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class UserResource extends Resource
{
    protected static ?string $model = User::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                TextInput::make('name')->required()->maxLength(255),
                TextInput::make('email')->required()->email()->maxLength(255),
                TextInput::make('password')
                    ->required()
                    ->password(fn (string $context) => $context === 'create')
                    ->dehydrated(fn ($state) => filled($state))
                    ->maxLength(255),
                Forms\Components\Select::make('role_id')
                    ->label('Role')
                    ->required()
                    ->relationship('role', 'name'),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('serial_no')->label('No.')->sortable()->rowIndex(),
                TextColumn::make('name')->label('Name')->sortable()->searchable(),
                TextColumn::make('email')->label('Email')->sortable()->searchable(),
                TextColumn::make('role.name')->label('Role')->sortable()->searchable(),
                TextColumn::make('created_at')->label('Created At')->dateTime()->sortable()->searchable(),
                TextColumn::make('updated_at')->label('Updated At')->dateTime()->sortable()->searchable(),
                
            ])
            ->filters([
                Tables\Filters\Filter::make('role')
                    ->label('Role')
                    ->form([
                        Forms\Components\Select::make('role_id')
                            ->relationship('role', 'name')
                            ->label('Role'),
                    ])
                    ->query(function (Builder $query, array $data) {
                        if ($data['role_id']) {
                            $query->where('role_id', $data['role_id']);
                        }
                    }),

                Tables\Filters\TrashedFilter::make(),
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getRelations(): array
    {
        return [
            
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
