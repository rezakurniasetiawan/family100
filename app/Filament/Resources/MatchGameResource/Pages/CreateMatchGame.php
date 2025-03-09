<?php

namespace App\Filament\Resources\MatchGameResource\Pages;

use App\Models\Team;
use Filament\Actions;
use App\Models\Question;
use App\Models\MatchGame;
use Filament\Resources\Pages\CreateRecord;
use App\Filament\Resources\MatchGameResource;

class CreateMatchGame extends CreateRecord
{
    protected static string $resource = MatchGameResource::class;

    protected function getRedirectUrl(): string
    {
        return static::getResource()::getUrl('index');
    }

    protected function afterCreate(): void
    {
        $data = $this->record;
        $teamId = $data->team_id;
        $questionId = $data->question_id;

        $question = Question::where('id', $questionId)->first();
        $teams = Team::where('id', $teamId)->first();

        if ($questionId != null) {
            $updateQuestion = [
                'team_id' => $teamId,
                'answered' => 1,
            ];
            Question::where('id', $questionId)->update($updateQuestion);

            $updateTeam = [
                'score' => $teams->score + $question->points,
            ];
            Team::where('id', $teamId)->update($updateTeam);

            $updateMatchGame = [
                'information' => 'Question answered correctly',
                'answered' => 1,
            ];
            MatchGame::where('id', $data->id)->update($updateMatchGame);
        }else{
            $updateMatchGame = [
                'information' => 'Question not answered',
                'answered' => 0,
            ];
            MatchGame::where('id', $data->id)->update($updateMatchGame);
        }
    }
}
