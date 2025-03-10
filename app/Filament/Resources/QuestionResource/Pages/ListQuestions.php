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
            Actions\Action::make('delete-all')
                ->action(fn() => Question::query()->delete())
                ->color('danger')
                ->requiresConfirmation()
                ->modalHeading('Delete All Questions')
                ->modalDescription('Are you sure you want to delete all questions? This action cannot be undone.')
                ->modalSubmitActionLabel('Yes, reset all'),
        ];
    }
}
