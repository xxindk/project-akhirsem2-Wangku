<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pemasukan extends Model
{
    protected $fillable = ['nama', 'kategori_id', 'nominal', 'tanggal', 'foto'];

    public function kategori()
    {
        return $this->belongsTo(Kategori::class);
    }
}
