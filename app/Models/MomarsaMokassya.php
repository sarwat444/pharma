<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MomarsaMokassya extends Model
{
    use HasFactory;

    public  function files()
    {
        return $this->hasMany(MomarsatMokassyFile::class  , 'momarsa_id') ;
    }
    public function mokasher()
    {
        return $this->belongsTo(MokasherMokassy::class) ;
    }
    public function rating_momarsa()
    {
        return $this->hasOne(RatingMomarsa::class , 'momarsa_id') ;
    }

}
