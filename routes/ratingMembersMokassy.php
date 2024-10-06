<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Web\Admin\Admin\RatingMomarsatMokassyaController ;

Route::get('/ratingMokassyaLogin' , [RatingMomarsatMokassyaController::class , 'login'])->name('ratingMokassyaLogin');
Route::post('/ratingMokassyaLogin', [RatingMomarsatMokassyaController::class ,'ratingLogin'])->name('ratingMokassyaLogin') ;
/** admin dashboard routes */

Route::group(['middleware' => 'auth:ratingMokassayMember', 'as' => 'ratingmokassy.'], function () {

    Route::get('rating_mokassy/mayears/{college_id}' , [RatingMomarsatMokassyaController::class , 'mayer'])->name('mayears') ;
    Route::get('rating_mokassy/mokashers/{myear_id}' , [RatingMomarsatMokassyaController::class , 'mokashers'])->name('mokashers') ;
    Route::get('rating_mokassy/momarsat/{mokasher_id}' , [RatingMomarsatMokassyaController::class , 'momarsat'])->name('momarsat') ;
    Route::get('rating_mokassy/momarsa_files/{mokasher_id}' , [RatingMomarsatMokassyaController::class , 'momarsa_files'])->name('momarsa_files') ;
    Route::get('rating_mokassy/rating_momarsat/{momarsa_id}' , [RatingMomarsatMokassyaController::class , 'rating_momarsat'])->name('rating_momarsat') ;
    Route::post('rating_mokassy/store_momarse_rating' , [RatingMomarsatMokassyaController::class , 'store_momarse_rating'])->name('store_momarse_rating') ;
    Route::post('rating_mokassy/logout' , [RatingMomarsatMokassyaController::class , 'logout'])->name('logout') ;

});
