<?php

namespace App\Filament\Resources;

use App\Filament\Resources\MatchdayResource\Pages;
use App\Filament\Resources\MatchdayResource\RelationManagers;
use App\Models\Matchday;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Filament\Tables\Columns\{ImageColumn, TextColumn, ToggleColumn};
use Filament\Forms\Components\{Placeholder, TextInput, Toggle};
use Filament\Tables\Filters\SelectFilter;

class MatchdayResource extends Resource
{
    protected static ?string $model = Matchday::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';
    protected static ?string $navigationGroup = 'Play';
    protected static ?string $pluralModelLabel = 'Matchdays';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Placeholder::make('league_name')
                    ->label('League')
                    ->content(fn ($record) => $record?->league?->name ?? '-'),
                TextInput::make('name')
                    ->required()
                    ->maxLength(15),
                TextInput::make('slug')
                    ->required()
                    ->maxLength(30),
                TextInput::make('price')
                    ->required()
                    ->prefix('$')
                    ->numeric(),
                TextInput::make('high_prize')
                    ->required()
                    ->prefix('$')
                    ->numeric(),
                TextInput::make('low_prize')
                    ->required()
                    ->prefix('$')
                    ->numeric(),
                Toggle::make('current')
                    ->onColor('success')
                    ->offColor('danger'),
                Toggle::make('active')
                    ->onColor('success')
                    ->offColor('danger'),
                Toggle::make('visible')
                    ->onColor('success')
                    ->offColor('danger')
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('name')
                    ->sortable()
                    ->searchable(),
                TextColumn::make('slug'),
                ImageColumn::make('league.logo'),
                TextColumn::make('price')
                    ->numeric()
                    ->prefix('$'),
                TextColumn::make('high_prize')
                    ->numeric()
                    ->prefix('$'),
                TextColumn::make('low_prize')
                    ->numeric()
                    ->prefix('$'),
                ToggleColumn::make('current'),
                ToggleColumn::make('active'),
                ToggleColumn::make('visible'),
            ])
            ->filters([
                SelectFilter::make('league_id')
                    ->label('League')
                    ->relationship('League', 'name')
                    ->searchable()
                    ->preload(),
                SelectFilter::make('current')
                    ->options([
                        '1' => 'Yes',
                        '0' => 'No'
                    ]),
                SelectFilter::make('active')
                    ->options([
                        '1' => 'Yes',
                        '0' => 'No'
                    ]),
                SelectFilter::make('visible')
                    ->options([
                        '1' => 'Yes',
                        '0' => 'No'
                    ])
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
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListMatchdays::route('/'),
            'create' => Pages\CreateMatchday::route('/create'),
            'edit' => Pages\EditMatchday::route('/{record}/edit'),
        ];
    }
}
