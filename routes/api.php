<?php

use Illuminate\Http\Request;
use App\Project;
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

Route::get('/mock', function (Request $request) {
  return array(
    'msg' => 'Hello Laracon!'
  );
});

Route::post('/projects/save', function (Request $request) {
  $error_message = '';
  
  $model_name = 'App\\' . $request->model_name;
  
  $model_instance = new $model_name;

  $first = $model_instance::findOrFail($request->model_id);

  $first[$request->key] = $request->value;

  $result = $first->save();

  return array(
    'result' => $result,
    "message" => "saved a " . $request->model_nam,
    "log_message" => "saved a " . $request->model_name . " with ID " . $request->model_id . ". Key: " .  $request->key . " - Value: " .  $request->value,
    "model_name" => $request->model_name,
    "model_id" => $request->model_id,
    "key" => $request->key,
    "value" => $request->value,
    "error_message" => $error_message,
  );
});

Route::get('/projects', function (Request $request) {
  $projects = Project::all();
  $fields = Project::$fields;

  return array(
    'models' => $projects,
    'fields' => $fields,
  );
});

// Route::resource('project', )