<?php

namespace App\Filament\Resources;

use App\Filament\Resources\GameResource\Pages;
use App\Filament\Resources\GameResource\RelationManagers;
use App\Models\Game;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Filament\Tables\Columns\{ImageColumn, TextColumn, ToggleColumn};
use Filament\Tables\Filters\Filter;
use Filament\Forms\Components\Select;
use App\Models\League;
use App\Models\Round;


class GameResource extends Resource
{
    protected static ?string $model = Game::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';
    protected static ?string $navigationGroup = 'Catalogs';
    protected static ?string $pluralModelLabel = 'Games';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                //
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('round.name')
                    ->sortable()
                    ->searchable(),
                TextColumn::make('round.league.name')
                    ->sortable()
                    ->searchable(),
                ImageColumn::make('home.logo'),
                TextColumn::make('home_score')
                    ->label('Home Score')
                    ->numeric(),
                TextColumn::make('away_score')
                    ->label('Away Score')
                    ->numeric(),
                ImageColumn::make('away.logo'),
                TextColumn::make('date')
                    ->sortable()
                    ->date()
                    ->searchable(),
                TextColumn::make('time')
                    ->sortable()
                    ->searchable(),
            ])
            ->filters([
                Filter::make('league_round')
                    ->form([
                        Select::make('league_id')
                            ->label('League')
                            ->options(League::pluck('name', 'id'))
                            ->searchable()
                            ->reactive(),

                        Select::make('round_id')
                            ->label('Round')
                            ->options(fn (callable $get) =>
                                Round::query()
                                    ->when(
                                        $get('league_id'),
                                        fn ($q) => $q->where('league_id', $get('league_id'))
                                    )
                                    ->pluck('name', 'id')
                            )
                            ->searchable()
                            ->reactive(),
                    ])
                    ->query(function ($query, array $data) {
                        if (! empty($data['league_id'])) {
                            $query->whereHas(
                                'round.league',
                                fn ($q) => $q->where('id', $data['league_id'])
                            );
                        }

                        if (! empty($data['round_id'])) {
                            $query->where('round_id', $data['round_id']);
                        }
                    }),
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
            'index' => Pages\ListGames::route('/'),
            'create' => Pages\CreateGame::route('/create'),
            'edit' => Pages\EditGame::route('/{record}/edit'),
        ];
    }
}
