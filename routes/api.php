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
//Route::group(['prefix' => 'okrs'], function(){
Route::resource('okrs','OkrsController');
Route::resource('krs','KrsController');
Route::get('/okrs/{id}/status', 'OkrsController@status');
//    Route::get('/', function(Request $request)
//    {
//        return App\Okr::with('krs')->get();
//    });
//    Route::get('/{id}', function($id){
//        return App\Okr::find($id)->load(['krs', 'krs.tasks', 'krs.tasks.user', 'user','comments']);
//    });
//});

Route::group(['prefix' => 'krs'], function(){
    Route::get('/', function(Request $request){
        return App\kr::with('tasks')->get();
    });
    Route::get('/{id}', function($id){
        return App\kr::find($id)->load(['Okr','tasks']);
    });
});
Route::post('/notes/add-note', function(Request $request){

});
Route::resource('comments', 'CommentController');
