<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Innvoice extends Model
{
    use HasFactory;

    public function medicines()
    {
        return $this->belongsToMany(Medicine::class)->withPivot('quantity', 'price');
    }
}
