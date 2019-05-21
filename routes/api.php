<?php

use Illuminate\Http\Request;

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

Route::group(['prefix' => 'users','middleware' => 'auth:api'], function(){
    Route::get('/', function(Request $request){
      return App\User::all();
    });
    Route::get('/current', function(Request $request){
      return $request->user()->only(['first_name',
          'last_name',
          'email',
          'title',
          'department']);
    });

});

//Route::group(['prefix' => 'okrs','middleware' => 'auth:api'], function(){
Route::group(['prefix' => 'okrs'], function(){
    Route::get('/', function(Request $request){
        return App\Okr::with('krs')->get();
    });



});

