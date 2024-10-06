<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Matarial extends Model
{
    use HasFactory;
    //مخرجات التعلم
    public function education_output()
    {
        return $this->hasMany('\App\Models\TeachingOutput' );
    }
    public  function descriptions()
    {
        return $this->hasMany('\App\Models\MatarialDescription') ;
    }
    public function innvoices()
    {
        return $this->hasMany('\App\Models\Innvoice') ;
    }
    public function innvoice_weeks()
    {
        return $this->hasMany('\App\Models\InnvoiceWeek') ;
    }
    public function survey()
    {
        return $this->hasMany('\App\Models\Survey') ;
    }
    public function teaching_output()
    {
        return $this->hasMany(TeachingOutput::class) ;
    }
    public  function program()
    {
        return  $this->belongsTo(Program::class , 'program_id') ;
    }
    public function programOutcomes()
    {
        return $this->belongsToMany(ProgramOutcome::class, 'material_output_program_outcome');
    }


}
