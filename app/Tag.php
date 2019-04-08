<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{
    protected $fillable = [
        'question', 'question_detailed', 'answer', 'rating'
    ];

    public function questions() {
        return $this->belongsToMany('App\Question');
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
    ];
        
}
