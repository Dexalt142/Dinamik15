<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Team extends Model
{
    protected $fillable = [
        'name', 'asal_sekolah', 'lolos_final', 'juara', 'competition_id', 'user_id'
    ];

    public function user() {
        return $this->belongsTo(\App\User::class);
    }

    public function competition() {
        return $this->hasOne(\App\Competition::class);
    }

    public function payment() {
        return $this->hasOne(\App\Payment::class);
    }

    public function members() {
        return $this->hasMany(\App\TeamMember::class);
    }

    public function creation() {
        return $this->hasOne(\App\Creation::class);
    }

    public function instructor() {
        return $this->hasOne(\App\Instructor::class);
    }
}
