<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MatchGame extends Model
{
    protected $fillable = ['team_id'];

    public function team()
    {
        return $this->belongsTo(Team::class);
    }

    public function question()
    {
        return $this->belongsTo(Question::class)->whereNull('team_id');
    }
    
}
