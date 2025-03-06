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
            Actions\CreateAction::make()
        ];
    }
}
