<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Testing\Fluent\Concerns\Has;

class dokumen extends Model
{
    use HasFactory;

    protected $table = 'dokumens';

    protected $fillable = [
        'jenis_arsip',
        'tanggal',
        'namapemilik',
        'keterangan',
        'file',
    ];
}
