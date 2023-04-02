<?php

namespace App\Listeners;

use App\Events\OrderCreated;
use App\Models\Cart;
use App\Models\Order;
use App\Models\Product;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\DB;

class DeductProductQuantity
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  object  $event
     * @return void
     */
    public function handle(OrderCreated $event)
    {
        $order =$event->order;

        // UPDATE products SET quantity = quantity - 1
        try {
           // foreach (Cart::get() as $item) {
            foreach ($order->products as $product){
                 //Product::where('id', '=', $item->product_id)->update(['quantity' => DB::raw("quantity - {$item->quantity}")]);
                //dd($product->pivot->quantity);
                $product->decrement('quantity', $product->order_item->quantity);    //$product->pivot->quantity

            }
        } catch (Throwable $e) {

        }

    }
}
