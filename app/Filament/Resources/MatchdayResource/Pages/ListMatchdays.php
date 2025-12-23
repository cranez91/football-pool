<?php

namespace App\Filament\Resources\MatchdayResource\Pages;

use App\Filament\Resources\MatchdayResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListMatchdays extends ListRecords
{
    protected static string $resource = MatchdayResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
