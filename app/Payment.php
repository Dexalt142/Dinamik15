<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    protected $fillable = [
        'file_name', 'nama_pengirim', 'status_upload_bukti', 'status_verifikasi', 'team_id'
    ];

    public function team() {
        return $this->belongsTo(\App\Team::class);
    }
}
