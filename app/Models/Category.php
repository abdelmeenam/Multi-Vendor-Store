<?php

namespace App\Models;

use App\Rules\CategoryFilter;
use Illuminate\Contracts\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;
    protected $fillable =['parent_id' , 'name' , 'slug' , 'description' , 'image' , 'status'];


    /**
     * @param Builder $builder
     * @param $status
     * @return void\
     */
    public function scopeFiler(Builder $builder , $filters )
    {
        $builder->when($filters['name'] ?? false , function ($builder , $value ){
            $builder->where('name' , 'LIKE' , "%{$value}%");
        });

        $builder->when($filters['status'] ?? false , function ($builder , $value){
            $builder->whereStatus($value);
        });
        //if ($filters['name'] ?? false){
        //    $builder->where('name' , 'LIKE' , "%{$filters['name']}%");
        //}
        // if ($filters['status'] ?? false){
        //   $builder->whereStatus($filters['status']);
        // }
    }

    /**
     * @param $categoryId
     * @return array
     */
    public static function rules($categoryId = 0)
    {
        return [
            "name" => [
                'required' ,
                'string',
                "unique:categories,name,$categoryId" ,
                /* function($attrivute , $value ,  $fails)
                {
                    if (strtolower($value) == 'laravel')
                    {
                        $fails('this name is forbidden');
                    }
                }*/
                new CategoryFilter('laravel')
            ],
            'parent_id' => ['nullable' , 'int' , 'exists:categories,id'],
            'image' => ['image','max:1048576'  ],
            'status' => 'in:active,archived| required',

        ];
    }

}
