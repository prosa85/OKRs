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

//Route::get('/', function () {
//    return view('welcome');
//});

Auth::routes();


Route::fallback( 'HomeController@index')->name('home');
//Route::get('/users', 'HomeController@index');
////Route::get('/users', 'UsersController@index');
//Route::group(['prefix' => 'okrs'], function(){
//    Route::get('/', function(Request $request){
//        return App\Okr::with('krs')->get();
//    });
//    Route::get('/{id}', function($id){
//        return App\Okr::find($id)->load(['user','krs']);
//    });
//});
//
//Route::group(['prefix' => 'krs'], function(){
//    Route::get('/', function(Request $request){
//        return App\kr::with('tasks')->get();
//    });
//    Route::get('/{id}', function($id){
//        return App\kr::find($id)->load(['Okr','tasks']);
//    });
//});
