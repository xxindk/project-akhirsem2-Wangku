<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TransaksiUtangPiutang extends Model
{
    use HasFactory;

    protected $fillable = [
        'jenis',
        'nominal',
        'bunga',
        'jatuh_tempo',
        'status',
    ];
}
