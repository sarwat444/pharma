<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MayearMokassy extends Model
{
    use HasFactory;

    public function mokashers()
    {
        return $this->hasMany(MokasherMokassy::class ) ;
    }
    public function college()
    {
        return $this->belongsTo(College::class , 'college_id') ;
    }

}
