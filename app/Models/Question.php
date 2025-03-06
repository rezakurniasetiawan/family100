<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Question extends Model
{
    protected $fillable = ['question', 'answer', 'points', 'team_id'];

    public function team()
    {
        return $this->belongsTo(Team::class);
    }
}
