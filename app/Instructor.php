<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Instructor extends Model
{
    protected $fillable = [
        'name', 'nip', 'no_telp', 'team_id'
    ];

    public function team() {
        return $this->belongsTo(\App\Team::class);
    }
}
