<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\App;

class StudentResult extends Model
{
    use HasFactory;
    public function student()
    {
        return $this->belongsTo(Student::class , 'student_id' , 'id') ;
    }
    public function question()
    {
        return $this->belongsTo(Question::class , 'question_id' ,  'id') ;
    }
}
