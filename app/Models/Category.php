<?php

namespace App\Models;

use App\Rules\CategoryFilter;
use Illuminate\Contracts\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Category extends Model
{
    use HasFactory, SoftDeletes;
    protected $fillable = ['parent_id', 'name', 'slug', 'description', 'image', 'status'];


    //Local scopes
    public function scopeFiler(Builder $builder, $filters)
    {
        $builder->when($filters['name'] ?? false, function ($builder, $value) {
            $builder->where('name', 'LIKE', "%{$value}%");
        });

        $builder->when($filters['status'] ?? false, function ($builder, $value) {
            $builder->whereStatus($value);
        });
    }



    public function products()
    {
        return $this->hasMany(Product::class, 'category_id', 'id');
    }

    public function children()
    {
        return $this->hasMany(Category::class, 'parent_id', 'id');
    }

    public function parent()
    {
        return $this->belongsTo(Category::class, 'parent_id', 'id')->withDefault();
    }


    public static function rules($categoryId = 0)
    {
        return [
            "name" => [
                'required',
                'string',
                "unique:categories,name,$categoryId",
                /* function($attrivute , $value ,  $fails)
                {
                    if (strtolower($value) == 'laravel')
                    {
                        $fails('this name is forbidden');
                    }
                }*/
                new CategoryFilter('laravel')
            ],
            'parent_id' => ['nullable', 'int', 'exists:categories,id'],
            'image' => ['image', 'max:1048576'],
            'status' => 'in:active,archived| required',

        ];
    }
}
