<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Question extends Model
{

   use HasFactory;
   public function student_grades()
   {
     return $this->hasMany(\App\Models\StudentResult::class , 'question_id' , 'id');
   }
   public  function teaching_output()
   {
       return $this->belongsTo(\App\Models\TeachingOutput::class  , 'teaching_outputs_id' , 'id') ;
   }
}
