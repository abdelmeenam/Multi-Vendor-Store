<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;

class Order extends Model
{
    use HasFactory;
    protected $fillable = [
        'store_id', 'user_id', 'payment_method', 'status', 'payment_status',
    ];

    protected static function booted()
    {
        static::creating(function(Order $order){
            //number : 20220001 - 20220002
            $order->number =Order::getNextOrderNumber();
        });

    }

    public static function getNextOrderNumber()
    {
        $year = Carbon::now()->year();
        $number =Order::whereYear('created_at' , $year )->max('number');
        if ($number)
        {
           return $number +1;
        }
        return $number . '0001';
    }

    public function user()
    {
        return $this->belongsTo(User::class)->withDefault([
            'name' => 'Guest Customer'
        ]);
    }

    public function store()
    {
        return $this->belongsTo(Store::class);
    }

    public function products()
    {
        //by using() : it makes pivot table orderItemClass instead of general(standard class)
        return $this->belongsToMany(Product::class, 'order_items', 'order_id', 'product_id', 'id', 'id')
            ->using(OrderItem::class)
            ->as('order_item')
            ->withPivot([                                              //to get pivot data
                'product_name', 'price', 'quantity', 'options',
            ]);
    }

    //return all addresses
    public function addresses()
    {
        return $this->hasMany(OrderAddress::class);
    }

    //return single address
    public function billingAddress()
    {
        //return the whole model
        return $this->hasOne(OrderAddress::class, 'order_id', 'id')
            ->where('type', '=', 'billing');

        //return $this->addresses()->where('type', '=', 'billing');         //return collection of one item
    }
    public function shippingAddress()
    {
        return $this->hasOne(OrderAddress::class, 'order_id', 'id')
            ->where('type', '=', 'shipping');
    }


}

