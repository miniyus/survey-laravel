<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::fallback(function(){
    return view('index');
});

//Route::get('/', function () {
//    return redirect('survey');
//});
//
//Route::get('/survey', function () {
//    return view('survey.index');
//});
//
//Route::get('/survey/create', function () {
//    return view('survey.create');
//});
//
//Route::get('/survey/{id}', function (int $id) {
//    return view('survey.show', ['id' => $id]);
//});
//
