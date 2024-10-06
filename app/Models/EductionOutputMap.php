<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EductionOutputMap extends Model
{
    use HasFactory;

    public function teaching_output()
    {
        return $this->belongsTo(TeachingOutput::class , 'teaching_outputs_id' );
    }
}
