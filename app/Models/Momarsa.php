<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Momarsa extends Model
{
    use HasFactory;
    public  function files()
    {
      return $this->hasMany(MomarsatFile::class) ;
    }
    public function mokasher()
    {
        return $this->belongsTo(Mokasher::class) ;
    }
    public function rating_momarsa()
    {
        return $this->hasOne(RatingMomarsa::class , 'momarsa_id') ;
    }

}
