<?php

namespace App\Filament\Resources\TeamResource\Pages;

use Filament\Actions;
use App\Filament\Resources\TeamResource;
use App\Models\Team;
use Filament\Resources\Pages\ListRecords;

class ListTeams extends ListRecords
{
    protected static string $resource = TeamResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\Action::make('reset-score')
                ->action(fn() => Team::query()->update(['score' => 0]))
                ->requiresConfirmation()
                ->color('danger')
                ->modalHeading('Reset All Scores')
                ->modalDescription('Are you sure you want to reset all teams\' scores? This action cannot be undone.')
                ->modalSubmitActionLabel('Yes, reset all'),
        ];
    }
}
