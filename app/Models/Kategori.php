<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Kategori extends Model
{
      protected $table = 'kategoris'; 
    protected $fillable = ['nama', 'jenis'];

public function pemasukan()
{
    return $this->hasMany(Pemasukan::class);
}

public function pengeluaran()
{
    return $this->hasMany(Pengeluaran::class);
}
}

