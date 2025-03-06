<?php

namespace App\Filament\Resources\MatchGameResource\Pages;

use App\Filament\Resources\MatchGameResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditMatchGame extends EditRecord
{
    protected static string $resource = MatchGameResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
