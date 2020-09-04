<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Creation extends Model
{
    protected $fillable = [
        'proposal', 'karya', 'team_id'
    ];

    public function team() {
        return $this->belongsTo(\App\Team::class);
    }
}
