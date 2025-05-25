<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TargetWangku extends Model
{
 protected $fillable = [
   'user_id',
    'nama_target',
    'jumlah_target',
    'jumlah_terkumpul',
    'gambar',
];


public function user()
{
    return $this->belongsTo(User::class);
}

}
