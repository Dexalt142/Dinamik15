<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Competition extends Model
{
    protected $fillable = [
        'name', 'type', 'price', 'awal_berkas', 'batas_berkas', 'awal_karya', 'batas_karya'
    ];

    protected $dates = [
        'awal_berkas', 'batas_berkas', 'awal_karya', 'batas_karya'
    ];

    public function teams() {
        return $this->hasMany(\App\Team::class);
    }
}
