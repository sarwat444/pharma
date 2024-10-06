<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TeachingOutput extends Model
{
    use HasFactory;
    public  function questions()
    {
        return $this->hasMany('\App\Models\Question' , 'teaching_outputs_id' ,'id');
    }
}
