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

use Illuminate\Routing\RouteGroup;

Route::get('/', function () {
    //with('data',2) passing value
    //return view('welcome')->with('data',2);

    //or
    //return view('welcome')->with(['string'=>'Ahmed Razzaq','age'=>27]);
    //or
    $data =[];
    $data['id'] =5;
    $data['name'] = 'Ahmed Razzaq from route';
    $data= ['ali', 'zahraa'];
    return view('welcome')->with('data', $data);
    //return view('welcome', $data);

    $obj = new stdClass();
    $obj-> name = 'Hamoodee from route';
    $obj-> id = 6;
    $obj-> gender = 'male';
    //return view('welcome');
});
Route::get('/about-me', function () {
    return view('about');
});


///or///
//Route::view('URI', 'viewName');
Route::view('contact-me', 'contact');

///or///

//('URI', 'viewName', Array of data)
Route::view('contact-me', 'contact', [
    'page_name' =>'contact me page',
    'page_description' =>'this is description'
]);

//route name
Route::get('/category', function () {
    
})->name('cat');

//route namespace 

// name of folder is front
//Route::namespace('front')->group(function(){

//multi route in folder
/*
Route::get('users', 'UserController@showUserName');

});
*/

//prefix
/*
Route::prefix('users')->group(function(){
    Route::get('show', 'UserController@showUserName');
    Route::delete('delete', 'UserController@showUserName');
    Route::get('edit', 'UserController@showUserName');
    Route::put('update', 'UserController@showUserName');
});
*/
Route::get('index','Front\UserController@getindex')->name('index');

/*
Route::group(['prefix' => 'users2'], function () {
    //set of routes
    Route::get('/', function () {
        return 'Work';
    });
    Route::get('show', 'UserController@showUserName');
    Route::delete('delete', 'UserController@showUserName');
    Route::get('edit', 'UserController@showUserName');
    Route::put('update', 'UserController@showUserName');
});
*/

//type1 middleware
/* 
Route::group(['prefix' => 'users2', middleware => 'auth'], function () {
    //set of routes
    Route::get('/', function () {
        return 'Work';
    });
    Route::get('show', 'UserController@showUserName');
    Route::delete('delete', 'UserController@showUserName');
    Route::get('edit', 'UserController@showUserName');
    Route::put('update', 'UserController@showUserName');
});
*/

// middlewere use of prevent enter page or use auth login
//type2 middleware

Route::get('check', function () {
   return 'middlewere'; 
})->middleware('auth');

/*
Route::get('users','UserController@index')->middleware('auth');
*/
/*
Route::group(['middleware' => 'auth'], function () {

    route::get('users','UserController@index');
    route::get('users','UserController@index');
    route::get('users','UserController@index');
    route::get('users','UserController@index');
});
*/

Route::get('second', 'Admin\SecondController@showString');
//or
Route::group(['namespace' => 'Admin'], function () {
    Route::get('second', 'SecondController@showString0')->middleWare('auth');
    Route::get('second1', 'SecondController@showString1');
    Route::get('second2', 'SecondController@showString2');
    Route::get('second3', 'SecondController@showString3');

});


Route::get('login', function () {
    return 'Must be login';
})->name('login');

//Route::resource('user', 'UserController');
Route::resource('news', 'NewsController');

Route::get('landing', function () {
    return view('landing');
});
Route::get('abouts', function () {
    return view('abouts');
});
Auth::routes(['verify'=>true]);

Route::get('/home', 'HomeController@index')->name('home')->middleware('verified');

Route::get('/dashboard', function () {
    return 'dashboard';
});

Route::get('redirect/{service}', 'SocialController@redirect');
Route::get('callback/{service}', 'SocialController@callback');
Route::get('fillable', 'CrudController@getOffers');

//////

    Route::group(['prefix' => LaravelLocalization::setLocale(), 'middleware' => [ 'localeSessionRedirect', 'localizationRedirect', 'localeViewPath' ]], function () {
        Route::group(['prefix' => 'offers'], function () {
                //Route::get('store', 'CrudController@store');
            Route::get('create', 'CrudController@create');  
            Route::post('store', 'CrudController@store')->name('offers.store');
            Route::get('all','CrudController@getAllOffers');
        });
    });
    
    
   
