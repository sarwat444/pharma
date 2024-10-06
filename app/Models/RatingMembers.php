<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;

class RatingMembers extends Authenticatable
{
    use HasFactory;

    protected $guard = "ratingMember" ;

    public function college()
    {
        return $this->belongsTo(College::class , 'college_id') ;
    }
}
