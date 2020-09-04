<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TeamMember extends Model
{
    protected $fillable = [
        'name', 'nisn', 'pas_foto', 'ktp', 'no_telp', 'team_id'
    ];

    public function team() {
        return $this->belongsTo(\App\Team::class);
    }
}
