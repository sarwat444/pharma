<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;

class RatingMokassyaMembers extends Authenticatable
{
    use HasFactory;

    public function college()
    {
        return $this->belongsTo(College::class , 'college_id') ;
    }

    public function mayear()
    {
        return $this->belongsTo(MayearMokassy::class , 'mayear_id') ;
    }

}
