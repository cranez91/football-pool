<?php

namespace App\Filament\Resources;

use App\Filament\Resources\SeasonResource\Pages;
use App\Filament\Resources\SeasonResource\RelationManagers;
use App\Models\Season;
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

class SeasonResource extends Resource
{
    protected static ?string $model = Season::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';
    protected static ?string $navigationGroup = 'Catalogs';
    protected static ?string $pluralModelLabel = 'Seasons';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Placeholder::make('league_name')
                    ->label('League')
                    ->content(fn ($record) => $record?->league?->name ?? '-'),
                TextInput::make('year')
                    ->readOnly()
                    ->disabled(),
                Toggle::make('current')
                    ->onColor('success')
                    ->offColor('danger')
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('year')
                    ->sortable()
                    ->searchable(),
                ToggleColumn::make('current'),
                ImageColumn::make('league.logo'),
                ImageColumn::make('league.country.flag'),
                TextColumn::make('start')
                    ->date(),
                TextColumn::make('end')
                    ->date(),
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
            'index' => Pages\ListSeasons::route('/'),
            'create' => Pages\CreateSeason::route('/create'),
            'edit' => Pages\EditSeason::route('/{record}/edit'),
        ];
    }
}
