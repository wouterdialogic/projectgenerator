<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Project;
use App\Page;

class ProjectController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $projects = Project::orderBy('order', 'ASC')->get();
        $fields = Project::$fields;

        return array(
            'models' => $projects,
            'fields' => $fields,
        );
    }

    public function indexonly()
    {
        return Project::all();
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
    //    dd($request->new_model);

       $project = new Project;

       foreach ($request->new_model as $key => $value) {
           $project[$key] = $value;
       }

       $project->save();

       return "project saved";
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $project = Project::create($request->all());
        
        return $project;
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($project_id)
    {
        //return "ok";
        // return $project_id;
        $project = Project::where('id', $project_id)->first();
        
        //return $projects;
        $pages = Page::where('project_id', $project_id)->get();
        // dd($pages);
        $fields = Page::$fields;
      
        return array( 
          'model_parent' => $project,
          'models' => $pages,
          'fields' => $fields,
          'model_parent_name' => 'project',
          'model_children_name' => 'page',
        );
        
        //return Project::findOrFail($id);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function save(Request $request)
    {
        $error_message = '';
  
        $model_parent_name = 'App\\' . $request->model_parent_name;
        
        $model_instance = new $model_parent_name;

        if (!empty($request->models)) {
            $models_saved = 0;
            foreach ($request->models as $model) {
            $model_instance = new $model_parent_name;
            $found = $model_instance->where('id', $model["id"])->first();
            
            foreach ($model as $key => $value) {
                $found[$key] = $value;
            }

            $found->save();
            $models_saved ++;
            }
            
            return 'models saved: ' . $models_saved;
        
            //just one model:
        } else {
            $model_instance = new $model_parent_name;
            $first = $model_instance::findOrFail($request->model_id);
            $first[$request->key] = $request->value;
            $result = $first->save();

            return array(
            'result' => $result,
            "message" => "saved a " . $request->model_nam,
            "log_message" => "saved a " . $request->model_parent_name . " with ID " . $request->model_id . ". Key: " .  $request->key . " - Value: " .  $request->value,
            "model_parent_name" => $request->model_parent_name,
            "model_id" => $request->model_id,
            "key" => $request->key,
            "value" => $request->value,
            "error_message" => $error_message,
            );
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $project = Project::findOrFail($id);
        $project->update($request->all());

        return $project;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $project = Project::findOrFail($id);
        $project->delete();
        
        return '';
    }
}
