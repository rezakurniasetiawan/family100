<?php

namespace App\Filament\Resources\MatchGameResource\Pages;

use App\Filament\Resources\MatchGameResource;
use App\Models\MatchGame;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListMatchGames extends ListRecords
{
    protected static string $resource = MatchGameResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
            Actions\Action::make('delete-all')
                ->action(fn() => MatchGame::query()->delete())
                ->color('danger')
                ->requiresConfirmation()
                ->modalHeading('Delete All Match Games')
                ->modalDescription('Are you sure you want to delete all match games? This action cannot be undone.')
                ->modalSubmitActionLabel('Yes, delete all'),
        ];
    }
}
