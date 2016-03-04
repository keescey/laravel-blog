<?php

/*
|--------------------------------------------------------------------------
| Routes File
|--------------------------------------------------------------------------
|
| Here is where you will register all of the routes in an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

Route::get('/', function () {
    return view('index');
});

Route::group(['prefix' => 'api'], function() {

  Route::resource('authenticate', 'AuthenticateController', ['only' => ['index']]);
  Route::post('authenticate', 'AuthenticateController@authenticate');

  Route::get('posts/{id?}', 'PostsController@index');
  Route::post('posts', 'PostsController@store');
  Route::post('posts/{id}', 'PostsController@update');
  Route::delete('posts/delete/{id}', 'PostsController@destroy');

  Route::get('comments/{id?}', 'CommentsController@index');
  Route::get('comments/bypost/{post_id?}', 'CommentsController@showByPost');
  Route::post('comments', 'CommentsController@store');

});


/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| This route group applies the "web" middleware group to every route
| it contains. The "web" middleware group is defined in your HTTP
| kernel and includes session state, CSRF protection, and more.
|
*/

Route::group(['middleware' => ['web']], function () {
    //
});
