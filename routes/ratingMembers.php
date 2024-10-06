<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Web\Admin\Admin\RatingMomarsatController ;

Route::get('/ratingLogin' , [RatingMomarsatController::class , 'login'])->name('ratingLogin');
Route::post('/ratingLogin', [RatingMomarsatController::class ,'ratingLogin'])->name('ratingLogin') ;
/** admin dashboard routes */

Route::group(['middleware' => 'auth:ratingMember', 'as' => 'rating.'], function () {

    Route::get('rating/programs' , [RatingMomarsatController::class , 'programs'])->name('programs') ;
    Route::get('rating/mayears/{program_id}' , [RatingMomarsatController::class , 'mayer'])->name('mayer') ;
    Route::get('rating/mokashers/{myear_id}' , [RatingMomarsatController::class , 'mokashers'])->name('mokashers') ;
    Route::get('rating/momarsat/{mokasher_id}' , [RatingMomarsatController::class , 'momarsat'])->name('momarsat') ;
    Route::get('rating/momarsa_files/{mokasher_id}' , [RatingMomarsatController::class , 'momarsa_files'])->name('momarsa_files') ;
    Route::get('rating/rating_momarsat/{momarsa_id}' , [RatingMomarsatController::class , 'rating_momarsat'])->name('rating_momarsat') ;
    Route::post('rating/store_momarse_rating' , [RatingMomarsatController::class , 'store_momarse_rating'])->name('store_momarse_rating') ;
    Route::post('rating/logout' , [RatingMomarsatController::class , 'logout'])->name('logout') ;

});
