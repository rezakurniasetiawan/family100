<?php

namespace App\Filament\Resources\MatchGameResource\Pages;

use App\Models\Team;
use Filament\Actions;
use App\Models\Question;
use App\Models\MatchGame;
use Filament\Resources\Pages\CreateRecord;
use App\Filament\Resources\MatchGameResource;
use App\Models\Answer;

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
        $questionId = $data->question_id;
        $teamId = $data->team_id;
        $answerId = $data->answer_id;

        $system = Team::where('type', 'system')->first();
        $answer = Answer::where('id', $answerId)->first();
        $teams = Team::where('id', $teamId)->first();

        $count = Answer::where('question_id', $questionId)
            ->whereNull('team_id')
            ->count();

        if ($answerId != null && $teamId != $system->id) {
            $updateQuestion = [
                'team_id' => $teamId,
                'answered' => 1,
            ];
            Answer::where('id', $answerId)->update($updateQuestion);

            $updateTeam = [
                'score' => $teams->score + $answer->points,
            ];
            Team::where('id', $teamId)->update($updateTeam);

            $updateMatchGame = [
                'information' => 'Question answered correctly',
                'answered' => 1,
            ];
            MatchGame::where('id', $data->id)->update($updateMatchGame);
        } else {
            if ($teamId == $system->id && $answerId != null) {
                $updateQuestion = [
                    'team_id' => $teamId,
                    'answered' => 3,
                ];
                Answer::where('id', $answerId)->update($updateQuestion);
                $updateMatchGame = [
                    'information' => "System Autocorrect 1 question(s)",
                    'answered' => 0,
                ];
                MatchGame::where('id', $data->id)->update($updateMatchGame);
            } else  if ($teamId == $system->id) {
                Answer::where('question_id', $questionId)
                    ->whereNull('team_id')
                    ->update([
                        'answered' => 3,
                        'team_id' => $teamId,
                    ]);

                $updateMatchGame = [
                    'information' => "System Autocorrect $count question(s)",
                    'answered' => 0,
                ];
                MatchGame::where('id', $data->id)->update($updateMatchGame);
            } else {
                $updateMatchGame = [
                    'information' => 'Question not answered',
                    'answered' => 0,
                ];
                MatchGame::where('id', $data->id)->update($updateMatchGame);
            }
        }
    }
}
