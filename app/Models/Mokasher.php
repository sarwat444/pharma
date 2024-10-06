<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Mokasher extends Model
{
    use HasFactory;
    public function momarsat()
    {
        return $this->hasMany(Momarsa::class) ;
    }
    public function mayer()
    {
        return $this->belongsTo(Myear::class , 'myear_id') ;
     }

}
