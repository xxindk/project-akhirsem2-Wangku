<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pengeluaran extends Model
{
  protected $fillable = ['nama', 'user_id', 'kategori_id', 'nominal', 'tanggal', 'foto'];

    public function kategori()
    {
        return $this->belongsTo(Kategori::class);
    }
    // Di TransaksiUtangPiutang.php
public function user()
{
    return $this->belongsTo(User::class);
}

}
