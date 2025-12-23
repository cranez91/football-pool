<?php

namespace App\Filament\Resources;

use App\Filament\Resources\BroadcasterResource\Pages;
use App\Filament\Resources\BroadcasterResource\RelationManagers;
use App\Models\Broadcaster;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Filament\Forms\Components\{FileUpload, TextInput};
use Filament\Tables\Columns\{ImageColumn, TextColumn};

class BroadcasterResource extends Resource
{
    protected static ?string $model = Broadcaster::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';
    protected static ?string $navigationGroup = 'Catalogs';
    protected static ?string $pluralModelLabel = 'Broadcasters';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                TextInput::make('name')
                    ->required()
                    ->maxLength(15),
                FileUpload::make('logo')
                    ->preserveFilenames()
                    ->label('Logo')
                    ->image()
                    ->disk('broadcasters')
                    ->visibility('public')
                    ->previewable(true)
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('name')
                    ->sortable()
                    ->searchable(),
                ImageColumn::make('logo')
                    ->label('Logo')
                    ->disk('broadcasters')
                    ->toggleable()
            ])
            ->filters([
                //
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
            'index' => Pages\ListBroadcasters::route('/'),
            'create' => Pages\CreateBroadcaster::route('/create'),
            'edit' => Pages\EditBroadcaster::route('/{record}/edit'),
        ];
    }
}
