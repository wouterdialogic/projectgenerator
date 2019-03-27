<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Page;

class PageController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $pages = Page::all();
        $fields = Page::$fields;

        return array(
            'models' => $pages,
            'fields' => $fields,
        );
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $page = new Page;

        foreach ($request->new_model as $key => $value) {
            $page[$key] = $value;
        }

        $page->save();

        return "page saved";
    }

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
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
