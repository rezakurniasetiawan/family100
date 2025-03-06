<?php

namespace App\Filament\Resources\QuestionResource\Pages;

use Filament\Actions;
use App\Models\Question;
use Filament\Resources\Pages\ListRecords;
use Filament\Notifications\Notification;
use App\Filament\Resources\QuestionResource;

class ListQuestions extends ListRecords
{
    protected static string $resource = QuestionResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
            Actions\Action::make('reset-team')
                ->action(fn() => Question::query()->update(['team_id' => null]))
                ->color('danger')
                ->requiresConfirmation()
                ->modalHeading('Reset All Teams')
                ->modalDescription('Are you sure you want to reset all questions\' teams? This action cannot be undone.')
                ->modalSubmitActionLabel('Yes, reset all'),
        ];
    }
}
