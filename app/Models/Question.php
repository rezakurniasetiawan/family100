<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Question extends Model
{
    protected $fillable = ['question','segment_id'];

    public function Answer()
    {
        return $this->hasMany(Answer::class);
    }

    public function Segment()
    {
        return $this->belongsTo(Segment::class);
    }
    
}
