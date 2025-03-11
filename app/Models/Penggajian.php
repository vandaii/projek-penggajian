<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Penggajian extends Model
{
    use HasFactory;
    protected $fillable = [
        'user_id',
        'komponen_id',
        'gaji_pokok',
        'tanggal',
        'tunjangan',
        'potongan',
        'pph',
        'bpjs',
        'gaji_bersih',
    ];

    public function komponenGaji() {
        return $this->belongsTo(KomponenGaji::class);
    }

    public function user() {
        return $this->belongsTo(User::class);
    }
}
