<?php

namespace App\Providers;

use App\Models\Execution_year;
use App\Models\MokasherInput;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\ServiceProvider;
use App\Observers\CourseObserver;
use App\Models\Course;

class AppServiceProvider extends ServiceProvider
{

    public function register():void
    {
    }

    public function boot():void
    {
        Model::preventLazyLoading();
        Model::unguard();
    }
}
