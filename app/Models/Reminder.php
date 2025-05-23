<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Reminder extends Model
{
    protected $fillable = ['jenis_tagihan', 'nominal', 'jatuh_tempo', 'status'];

    // Hapus relasi user kalau gak pakai user
    // public function user()
    // {
    //     return $this->belongsTo(User::class);
    // }
}