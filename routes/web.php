<?php

use Illuminate\Support\Facades\Auth;
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

// Route::get('/', function () {
//     return view('welcome');
// });

Route::get('/', function () {
    return redirect('/login');
});

Auth::routes(['verify' => true]);

Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/home', 'HomeController@index')->name('home');
    Route::get('/dashboard', 'DashboardController@index')->name('dashboard');
    Route::get('/trailblazer', 'TrailblazerController@index')->name('trailblazer');
});


//Route::get('/restapis', 'FirstController@index');
////Route::get('/dashboard', 'DashboardController@index')->name('dashboard')->middleware('verified');;
//Route::get('/trailblazer', 'TrailblazerController@index')->name('trailblazer')->middleware('verified');;
// Route::get('/dashboard', function () {
//     return view('welcome');
// });


//API calls
Route::get('/trainees', 'TraineesController@index');
Route::get('/progresses', 'ProgressController@index');
