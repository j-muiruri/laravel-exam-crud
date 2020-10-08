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

Route::get('/', function () {
    return view('welcome');
});


Route::post('/create','App\Http\Controllers\ExamsController@createExam');
Route::get('/get', 'App\Http\Controllers\ExamsController@getExams');
Route::post('/delete/{id}', 'App\Http\Controllers\ExamsController@deleteExam');
Route::post('/update/{id}', 'App\Http\Controllers\ExamsController@editExam');

