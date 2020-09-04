<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Competition extends Model
{
    protected $fillable = [
        'name', 'type', 'price', 'batas_proposal', 'batas_karya'
    ];

    protected $dates = [
        'batas_proposal', 'batas_karya'
    ];

    public function teams() {
        return $this->hasMany(\App\Team::class);
    }
}
