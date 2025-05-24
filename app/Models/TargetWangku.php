<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TargetWangku extends Model
{
 protected $fillable = [
    'nama_target',
    'jumlah_target',
    'jumlah_terkumpul',
    'gambar',
];
}
