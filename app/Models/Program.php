<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Program extends Model
{
    use HasFactory;
    protected $dates = ['added_date'];
    public function mayears()
    {
        return $this->hasMany('\App\Models\Myear' , 'program_id' ,'id');
    }
    public function goals()
    {
        return $this->hasMany(Goal::class , 'program_id') ;
    }
    public function mind()
    {
        return $this->hasMany(Mind::class , 'program_id') ;
    }
    public function knowledge()
    {
        return $this->hasMany(Knowledge::class , 'program_id') ;
    }
    public function workskills()
    {
        return $this->hasMany(WorkSkill::class , 'program_id') ;
    }
    public function public_skills()
    {
        return $this->hasMany(PublicSkill::class , 'program_id') ;
    }
    public  function standars()
    {
        return $this->hasMany(Standard::class , 'program_id') ;
    }
    public function matarials()
    {
        return $this->hasMany(Matarial::class , 'program_id') ;
    }

}
