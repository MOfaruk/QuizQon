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

Auth::routes();
Route::get('/', 'HomeController@index')->name('home');
Route::get('/search/{term?}', 'HomeController@search')->name('search');

//User Quiz Routes
Route::group(['prefix'=>'quiz','as'=>'quiz.','middleware' => 'auth'], function () 
{
    Route::get('/{id}/{title?}', ['as'=>'arena','uses'=>'QuizControllerUser@show']);
    Route::get('/description/{id}/{title?}', ['as'=>'description','uses'=>'QuizControllerUser@showQuizDescription']);
    Route::get('/scoreboard/{id}/{title?}', ['as'=>'scoreboard','uses'=>'QuizControllerUser@scoreboard']);
    Route::get('/solution/{id}/{title?}', ['as'=>'solution','uses'=>'QuizControllerUser@solution']);
});

//User Quiz APIs Routes
Route::group(['middleware' => 'auth'], function () 
{
    Route::get('/quiz-api/{id}','QuizControllerUser@getquiz');
    Route::post('/quiz-api/{id}','QuizControllerUser@submitquiz');
    Route::get('/score-api/{qzId}','QuizControllerUser@showScore');
});

//User Dashboard Routes
Route::group(['prefix' => 'dashboard',  'middleware' => 'auth','as'=>'dashboard.'], function()
{
    Route::get('/', ['as'=>'index','uses'=>'UserDashboardController@index'] );
    Route::get('/contests', ['as'=>'quizzes','uses'=>'UserDashboardController@showQuizzes']);
    Route::get('/friends', ['as'=>'friends','uses'=>'UserDashboardController@showFriends'] );
    Route::get('/settings', ['as'=>'settings','uses'=>'UserDashboardController@showSettings'] );
    Route::get('/update-info', ['as'=>'update_view','uses'=>'UserDashboardController@updateInfoView'] );
    //api for score chart
    Route::get('/user-score/{id}', ['as'=>'uscore','uses'=>'UserDashboardController@getUserScores'] );
    Route::get('/add-friend/{id}', ['as'=>'addfiend','uses'=>'UserDashboardController@addFriend'] );
    Route::get('/remove-friend/{id}', ['as'=>'addfiend','uses'=>'UserDashboardController@removeFriend'] );

    //user info update
    Route::post('/update-account',['as'=>'update_account','uses'=>'UserDashboardController@updateAccount']);
    Route::post('/update-password',['as'=>'update_password','uses'=>'UserDashboardController@updatePassword']);
    Route::post('/update-info',['as'=>'update_info','uses'=>'UserDashboardController@updateInfo']);
});

Route::get('/user/{id}/{name?}','HomeController@showUserProfile')->name('user_profile');

// TBD: Make a middleware to control api before quiz start/end

//Admin Panel Routes
Route::group(['prefix'=>'admin','as'=>'admin.','middleware' => ['auth','role:admin,editor']], function () 
{
    Route::get('/',['as'=>'index','uses'=>'AdminPanelController@index']);
    Route::resource('quiz','QuizController');
    //quiz import from excel
    Route::resource('import-quiz','QuizImportController');
    
    //Post
    //Route::resource('admin/post','PostController');
});


Route::get('/auth/redirect/{provider}', 'SocialAuthController@redirect');
Route::get('/callback/{provider}', 'SocialAuthController@callback');

//Important Pages
Route::get('/about-us', function(){return view('pages.about-us');})->name('about');
Route::get('/contact-us', function(){return view('pages.contact-us');})->name('contact');
Route::get('/privacy-policy', function(){return view('pages.privacy');})->name('privacy');
Route::get('/terms-of-use', function(){return view('pages.tou');})->name('tou');
Route::get('/disclaimer', function(){return view('pages.disclaimer');})->name('disclaimer');
Route::get('/site-map', function(){return view('pages.about-us');})->name('sitemap');
