<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DemographicController;
use App\Http\Controllers\youthRegistrationController;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');


Route::get('/demographics', [DemographicController::class, 'getDemographic']);
Route::get('/demographics/{id}', [DemographicController::class, 'demographicID']);
Route::post('/addDemographic', [DemographicController::class, 'addDemographic']);
Route::put('/updateDemographic/{id}', [DemographicController::class, 'updateDemographic']);
Route::delete('/deleteDemographic/{id}', [DemographicController::class, 'deleteDemographic']);

Route::get('/youthregistration', [youthRegistrationController::class, 'youthregistration']);
Route::post('/addyouth', [youthRegistrationController::class, 'addyouth']);
Route::put('/updateyouth/{id}', [youthRegistrationController::class, 'updateyouth']);
Route::delete('/destroyyouth/{id}', [youthRegistrationController::class, 'destroyyouth']);
