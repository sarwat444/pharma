<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CategoryQuestion extends Model
{
    use HasFactory;
    public function questions()
    {
        return $this->hasMany('\App\Models\SurveyQuestion' , 'category_id' ,'id');
    }
}
