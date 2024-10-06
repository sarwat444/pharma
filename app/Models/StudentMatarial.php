<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StudentMatarial extends Model
{
    use HasFactory;

    public function matarial()
    {
        return $this->belongsTo(\App\Models\Matarial::class , 'matarial_id')  ;
    }

    public function student()
    {
        return $this->belongsTo(\App\Models\Student::class , 'student_id')  ;

    }

}
