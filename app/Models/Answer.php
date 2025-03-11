<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Answer extends Model
{
    protected $fillable = ['question_id', 'team_id', 'answer', 'points', 'answered'];

    public function team()
    {
        return $this->belongsTo(Team::class);
    }

    public function question()
    {
        return $this->belongsTo(Question::class);
    }
}
