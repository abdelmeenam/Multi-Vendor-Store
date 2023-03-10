<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $fillable = [
        'name', 'slug'
    ];
    public function products(){
        return $this->belongsToMany(
            Product::class ,      //Related model
            'product_table' ,     //Pivot table
            'tag_id'  ,    //FK of pivot table for the related
            'product_id',  //FK of pivot table for the current
            'id' ,             //PK Current
            'id'              //PK Related
        );
    }
}
