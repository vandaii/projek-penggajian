<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KomponenGaji extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'gaji_pokok',
        'tunjangan',
        'potongan',
        'lembur',
        'pph',
        'bpjs',
        'gaji_bersih'
    ];

    public function user() {
        return $this->belongsTo(User::class);
    }

    public function penggajian() {
        return $this->hasMany(Penggajian::class);
    }
}
