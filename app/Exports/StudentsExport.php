<?php

namespace App\Exports;

use App\Models\Student;
use Maatwebsite\Excel\Concerns\FromCollection;

class StudentsExport implements FromCollection
{
    /**
    * @return \Illuminate\Support\Collection
    */
    protected $material_id;
    public function __construct($material_id)
    {
        $this->material_id = $material_id;
    }
    public function collection()
    {
        return Student::select('name' , 'email' , 'user_password')->where([ 'matarial_id' => $this->material_id,])->get();
    }
 }
