<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Question extends Model
{
    protected $fillable = [
        'question', 'question_detailed', 'answer', 'rating'
    ];

    public function tags() {
        return $this->belongsToMany('App\Tag');
    }

    public static $fields = [
        "id" => [
            "database_name" => "id",
            "to_user_name" => "ID",
            "type" => "integer",
            "primary_key" => true,
            "editable_by_user" => true,
            "visible" => true,
            "nullable" => false,
        ],

        "question" => [
            "database_name" => "question",
            "to_user_name" => "Question",
            "database_type" => "string",
            "html_type" => "text",
            "element" => "input",
            "visible" => true,
            "nullable" => false,
        ],
        
        "question_detailed" => [
            "database_name" => "question_detailed",
            "to_user_name" => "Details",
            "database_type" => "text",
            "html_type" => "text",
            "element" => "textarea",
            "visible" => true,
            "nullable" => true,
        ],
        
        "answer" => [
            "database_name" => "answer",
            "to_user_name" => "Answer",
            "database_type" => "text",
            "html_type" => "text",
            "element" => "textarea",
            "visible" => true,
            "nullable" => true,
        ],
        
        "rating" => [
            "database_name" => "rating",
            "to_user_name" => "Rating",
            "database_type" => "integer",
            "html_type" => "number",
            "element" => "input",
            "visible" => true,
            "nullable" => true,
        ],

        "modified_by" => [
            "database_name" => "modified_by",
            "to_user_name" => "Modified by",
            "database_type" => "string",
            "html_type" => "text",
            "element" => "input",
            "visible" => false,
            "nullable" => true,
        ],

        "owner_name" => [
            "database_name" => "owner_name",
            "to_user_name" => "Askee",
            "database_type" => "string",
            "html_type" => "text",
            "element" => "input",
            "visible" => false,
            "nullable" => true,
        ],
    ];
}
