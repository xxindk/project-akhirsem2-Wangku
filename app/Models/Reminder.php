<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Reminder extends Model
{
    protected $fillable = ['user_id', 'jenis_tagihan', 'nominal', 'jatuh_tempo', 'status'];

public function user()
{
    return $this->belongsTo(User::class);
}

}