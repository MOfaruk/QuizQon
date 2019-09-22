<?php

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
/*
Route::get('/', function () {
    return view('welcome');
});
*/
Auth::routes();

Route::get('/', 'HomeController@index')->name('home');
Route::get('/scoreboard/{id}','QuizControllerUser@scoreboard');

//Only for Authinticated user
Route::group(['middleware' => ['auth']], function () {

    Route::resource('admin/quiz','QuizController');
    Route::get('/quiz/{id}', 'QuizControllerUser@show');
    Route::get('/quiz-api/{id}','QuizControllerUser@getquiz');
    Route::post('/quiz-api/{id}','QuizControllerUser@submitquiz');
    Route::get('/score-api/{qzId}','QuizControllerUser@showScore');

});


Route::group(['prefix' => 'dashboard',  'middleware' => 'auth','as'=>'dashboard.'], function()
{
    Route::get('/', ['as'=>'index','uses'=>'UserDashboardController@index'] );
});

// TBD: Make a middleware to control api before quiz start/end