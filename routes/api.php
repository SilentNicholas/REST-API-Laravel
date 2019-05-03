<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Task;


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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('tasks', function() {
    return Task::all();
});

Route::get('tasks/{id}', function($id) {
    return Task::find($id);
});

Route::post('tasks', function(Request $request) {
    return Task::create($request->all);
});

Route::put('tasks/{id}', function(Request $request, $id) {
    $task = Task::findOrFail($id);
    $task->update($request->all());

    return $task;
});

Route::delete('tasks/{id}', function($id) {
    Task::find($id)->delete();

    return 204;
});

Route::group(['middleware' => 'auth:api'], function() {
    Route::get('tasks', 'TaskController@index');
    Route::get('tasks/{task}', 'TaskController@show');
    Route::post('tasks', 'TaskController@store');
    Route::put('tasks/{task}', 'TaskController@update');
    Route::delete('tasks/{task}', 'TaskController@delete');
});

Route::post('register', 'Auth\RegisterController@register');
Route::post('login', 'Auth\LoginController@login');
Route::post('logout', 'Auth\LoginController@logout');
