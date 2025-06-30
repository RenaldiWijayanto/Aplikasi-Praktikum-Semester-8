<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class skmengajar extends Model
{
    use HasFactory;

    protected $table = 'skmengajars';

    protected $fillable = [
        'prodi',
        'semester',
        'tanggal',
        'file',
    ];

}
