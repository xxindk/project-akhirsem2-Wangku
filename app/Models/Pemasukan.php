<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;


class Pemasukan extends Model
{
    protected $table = 'pemasukans'; 

    protected $fillable = ['nama', 'user_id', 'kategori_id', 'nominal', 'tanggal', 'foto'];

    public function kategori()
    {
        return $this->belongsTo(Kategori::class, 'kategori_id');
    }
    // Di TransaksiUtangPiutang.php
public function user()
{
    return $this->belongsTo(User::class);
}


}
