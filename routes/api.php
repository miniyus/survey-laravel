<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});


Route::get('survey', [App\Http\Controllers\Api\SurveyController::class, 'index']);

Route::get('survey/{id}', [App\Http\Controllers\Api\SurveyController::class, 'show']);

Route::post('survey', [App\Http\Controllers\Api\SurveyController::class, 'store']);

Route::delete('survey/{id}', [App\Http\Controllers\Api\SurveyController::class, 'destroy']);

Route::get('survey/{surveyId}/result', [App\Http\Controllers\Api\SurveyResultController::class, 'index']);

Route::post('survey/{surveyId}/result', [App\Http\Controllers\Api\SurveyResultController::class, 'store']);

Route::get('survey/{surveyId}/result/{resultId}', [App\Http\Controllers\Api\SurveyResultController::class, 'show']);
