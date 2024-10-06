<?php

namespace App\Imports;

use App\Models\Student;
use Maatwebsite\Excel\Concerns\ToModel;

class StudentsImport implements ToModel
{
    protected $material_id;
    public function __construct($material_id)
    {
        $this->material_id = $material_id;
    }
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new Student([
            'name' => $row[0],
            'email' => $row[1],
            'password' => bcrypt($row[2]),
            'user_password' => $row[2],
            'matarial_id' => $this->material_id,
        ]);
    }
}
