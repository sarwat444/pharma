<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MokasherMokassy extends Model
{
    use HasFactory;

    public function momarsat()
    {
        return $this->hasMany(MomarsaMokassya::class ,'mokasher_id') ;
    }
    public function mayer()
    {
        return $this->belongsTo(MayearMokassy::class , 'mayear_mokassy_id') ;
    }


}
