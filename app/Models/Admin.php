<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Permission\Traits\HasRoles;
class Admin extends Authenticatable
{
    use HasFactory,HasRoles;
    protected $table = 'admins'; // Adjust table name if necessary
    public function college()
    {
        return $this->belongsTo(College::class , 'college_id') ;
    }
}
