<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;
    protected $fillable =['parent_id' , 'name' , 'slug' , 'description' , 'image' , 'status'];

    public static function rules($id = 0)
    {
        return [
            "name" => "required|string|unique:categories,name,$id",
            'parent_id' => ['nullable' , 'int' , 'exists:categories,id'],
            'image' => ['image','max:1048576'  ],
            'status' => 'in:active,archived | required'
        ];
    }

}
