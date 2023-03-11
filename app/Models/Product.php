<?php

namespace App\Models;

use App\Models\Scopes\StoreScope;
use Illuminate\Contracts\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'name', 'slug', 'description', 'image', 'category_id', 'store_id',
        'price', 'compare_price', 'status',
    ];

    protected static function booted()
    {
        //Global Filter to get only products of the auth user with his store
        static::addGlobalScope('store', new StoreScope);
    }

    public function category()
    {
        return $this->belongsTo(Category::class, 'category_id', 'id');
    }

    public function store()
    {
        return $this->belongsTo(Store::class, 'store_id', 'id');
    }

    public function tags(){
        return $this->belongsToMany(
          Tag::class ,      //Related model
          'product_tag' ,     //Pivot table
          'product_id',  //FK of pivot table for the current
          'tag_id'  ,    //FK of pivot table for the related
          'id' ,             //PK Current
          'id'              //PK Related
        );
    }
}
