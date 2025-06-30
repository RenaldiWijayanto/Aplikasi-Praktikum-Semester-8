<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Testing\Fluent\Concerns\Has;

class surat extends Model
{
    use HasFactory;

    protected $table = 'surats';

    protected $fillable = [
        'jenis_surat',
        'no_surat',
        'tanggal',
        'tujuan',
        'keterangan',
        'file'
    ];
}
