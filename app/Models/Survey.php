<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Survey extends Model
{
    use HasFactory;
    public function categories()
    {
        return $this->hasMany('\App\Models\CategoryQuestion' , 'survey_id' ,'id');
    }

    public function matarial()
    {
        return $this->belongsTo('\App\Models\Matarial' , 'matarial_id' , 'id') ;
    }
}
