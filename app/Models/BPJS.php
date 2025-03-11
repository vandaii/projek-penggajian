<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BPJS extends Model
{
    protected $fillable = [
        'name',
        'nominal',
    ];
}
