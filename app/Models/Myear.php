<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\App;

class Myear extends Model
{
    use HasFactory;
    public function mokashers()
    {
        return $this->hasMany(Mokasher::class ) ;
    }
    public function program()
    {
        return $this->belongsTo(Program::class , 'program_id') ;

    }
    public function rating_momarsas()
    {
        return $this->hasOne(RatingMomarsa::class) ;
    }
}
