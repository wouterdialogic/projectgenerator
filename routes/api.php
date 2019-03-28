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

Route::post('/page/create', 'PageController@create');

Route::post('/project/create', 'ProjectController@create');

Route::post('/project/save', 'ProjectController@save');

Route::post('/page/save', 'PageController@save');

Route::get('/project/{project_id}', 'ProjectController@show');
// Route::get('/project/{project_id}', function (Request $request) {

//   return $project_id;
//   $projects = Project::where('id', $project_id);
//   return $projects;
//   $pages = Pages::where('project_id', $project_id);
//   $fields = Project::$fields;

//   return array(
//     'models' => $projects,
//     'fields' => $fields,
//   );
// });

// Route::get('project', 'ProjectController@index' );
// Route::get('project/{project_id}', 'ProjectController@show' );
// Route::post('project/{project_id}', 'ProjectController@save' );
// Route::post('project/', 'ProjectController@create' );

// Route::get('page', 'PageController@index');
// Route::get('project/{project_id}/page/', 'PageController@index');
// Route::get('project/{project_id}/page/{page_id}', 'PageController@show');
// Route::post('project/{project_id}/page/{page_id}', 'PageController@save' );
// Route::post('project/{project_id}/page', 'PageController@create' );

Route::get('/pages', 'PageController@index');

Route::get('/projects', 'ProjectController@index');
Route::get('/projects', function (Request $request) {
  $projects = Project::all();
  $fields = Project::$fields;

  return array(
    'models' => $projects,
    'fields' => $fields,
  );
});

// Route::resource('project', )