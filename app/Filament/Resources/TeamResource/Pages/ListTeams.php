<?php

namespace App\Filament\Resources\TeamResource\Pages;

use Filament\Actions;
use Filament\Pages\Actions\Action;
use App\Filament\Resources\TeamResource;
use App\Models\Team;
use Filament\Resources\Pages\ListRecords;

class ListTeams extends ListRecords
{
    protected static string $resource = TeamResource::class;

}
