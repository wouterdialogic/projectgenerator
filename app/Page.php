<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Page extends Model
{
    public $name = 'Page';
    public static $name_plural = "Pages";

    public function project()
    {
        return $this->belongsTo('App\Project');
    }

   

    public static $fields = [
        "id" => [
            "database_name" => "id",
            "to_user_name" => "ID",
            "type" => "integer",
            "primary_key" => true,
            "editable_by_user" => false,
            "nullable" => false,
        ],

        "name" => [
            "database_name" => "name",
            "to_user_name" => "Name",
            "database_type" => "string",
            "html_type" => "text",
            "element" => "input",
            "visible" => true,
            "nullable" => false,
        ],
        
        "description" => [
            "database_name" => "description",
            "to_user_name" => "Description",
            "database_type" => "text",
            "html_type" => "text",
            "element" => "textarea",
            "visible" => true,
            "nullable" => true,
        ],
        
        "order" => [
            "database_name" => "order",
            "to_user_name" => "Order",
            "database_type" => "integer",
            "html_type" => "number",
            "element" => "input",
            "visible" => true,
            "nullable" => true,
        ],

        "project_id" => [
            "database_name" => "project_id",
            "to_user_name" => "Project id",
            "database_type" => "integer",
            "html_type" => "number",
            "element" => "input",
            "visible" => false,
            "nullable" => true,
        ],

    ];
}
