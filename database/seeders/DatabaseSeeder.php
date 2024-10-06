<?php

namespace Database\Seeders;

use App\Enums\InstructorRequestStatus;
use App\Models\College;
use App\Models\RatingMembers;
use Illuminate\Database\Seeder;
use App\Models\Admin;
use App\Models\User;
use App\Models\Student;
use App\Models\Matarial ;
use App\Models\Program ;
class DatabaseSeeder extends Seeder
{

    public function run(): void
    {
        College::factory(1)->create();
        Admin::factory(1)->create();
        User::factory(1)->create();
        Program::factory(1)->create()  ;
        Matarial::factory(2)->create() ;
      //  Student::factory(15)->create() ;
        RatingMembers::factory(1)->create() ;
    }
}
