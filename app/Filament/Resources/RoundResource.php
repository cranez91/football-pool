<?php

namespace App\Filament\Resources;

use App\Filament\Resources\RoundResource\Pages;
use App\Filament\Resources\RoundResource\RelationManagers;
use App\Models\Round;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Filament\Tables\Columns\{ImageColumn, TextColumn, ToggleColumn};
use Filament\Forms\Components\{Placeholder, TextInput};
use Filament\Tables\Filters\SelectFilter;

class RoundResource extends Resource
{
    protected static ?string $model = Round::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';
    protected static ?string $navigationGroup = 'Catalogs';
    protected static ?string $pluralModelLabel = 'Rounds';

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
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('name')
                    ->sortable()
                    ->searchable(),
                ToggleColumn::make('current'),
                ImageColumn::make('league.logo'),
                ImageColumn::make('league.country.flag'),
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
            'index' => Pages\ListRounds::route('/'),
            'create' => Pages\CreateRound::route('/create'),
            'edit' => Pages\EditRound::route('/{record}/edit'),
        ];
    }
}
