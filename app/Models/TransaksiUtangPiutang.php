<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TransaksiUtangPiutang extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'jenis',
        'nominal',
        'bunga',
        'jatuh_tempo',
        'status',
    ];

public function user()
{
    return $this->belongsTo(User::class);
}

}
