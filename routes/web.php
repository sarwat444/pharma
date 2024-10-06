
<?php

use App\Http\Controllers\Web\Home\{SurveyController ,LoginController ,MaterialsController } ;
use Illuminate\Support\Facades\Route;

    Route::get('login' , [LoginController::class , 'login'])->name('login');
    Route::post('check_login' , [LoginController::class , 'check_login'])->name('check_login');
    Route::get('/' , [LoginController::class , 'Home_page'])->name('Home_page') ;
    Route::get('/register' , [LoginController::class , 'register'])->name('register') ;
Route::post('/register', [LoginController::class, 'store'])->name('register.store');

    Route::group(['prefix' => 'home','middleware' => 'auth:student' ,'as' => 'home.'], function () {
        Route::get('/' , [LoginController::class , 'index'])->name('index') ;
        Route::get('ViewSurvey/{survey_id}', [SurveyController::class, 'show'])->name('survey.show');
        Route::get('materials' , [MaterialsController::class , 'materials'])->name('materials') ;
        Route::post('materials/store' , [MaterialsController::class , 'store'])->name('matarials.store') ;
        Route::get('survies/{matarial_id}' , [SurveyController::class , 'survies'])->name('matarials.survies') ;
        Route::get('survey/{survey_id}' , [SurveyController::class , 'show'])->name('survey') ;
        Route::post('/student-survey', [SurveyController::class, 'store'])->name('student-survey.store');

    });

?>
