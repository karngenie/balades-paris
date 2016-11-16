<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| This file is where you may define all of the routes that are handled
| by your application. Just tell Laravel the URIs it should respond
| to using a Closure or controller method. Build something great!
|
*/

// Route::get('/', function () {
//     return view('welcome');
// });
/*
Route::get('/', function () {
    return view('index');
});
*/
Route::get('/', 'IndexController@index');
//Route::get('/balade/{walk}', 'WalkController@index');
Route::get('/balade/{walk}', ['uses' => 'WalkController@index', 'as' => 'balade']);

Route::get('/admin/balade/{walk}', 'ManageWalkController@index');
Route::post('/admin/balade', 'ManageWalkController@manage');

Auth::routes();

Route::get('/home', 'HomeController@index');
