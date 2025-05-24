<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Reminder extends Model
{
    protected $fillable = ['jenis_tagihan', 'nominal', 'jatuh_tempo', 'status'];

}