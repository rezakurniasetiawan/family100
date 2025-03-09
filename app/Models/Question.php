<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Question extends Model
{
    protected $fillable = ['question'];

    public function Answer()
    {
        return $this->hasMany(Answer::class);
    }
    
}
