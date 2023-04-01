<?php

namespace App\Http\Controllers\Front;

use App\Events\OrderCreated;
use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\OrderItem;
use App\Repositories\Cart\CartRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Symfony\Component\Intl\Countries;

class CheckoutController extends Controller
{
    public function create(CartRepository $cart)
    {
        if ($cart->get()->count() == 0) {
            throw new InvalidOrderException('Cart is empty');
        }
        return view('front.checkout', [
            'cart' => $cart,
            'countries' => Countries::getNames(),
        ]);
    }

    public function store(Request $request , CartRepository $cart){

        $request->validate([
        ]);

        $items = $cart->get()->groupBy('product.store_id')->all(); //array with key(store_id) and value (items)
        DB::beginTransaction();
        try {
            foreach ($items as $store_id => $cart_items)
            {
                //create order
                $order = Order::create([
                    'store_id' => $store_id,
                    'user_id' => Auth::id(),
                    'payment_method' => 'cod'
                ]);

                //save order items from cart
                foreach ($cart_items as $item)
                {
                    //dd( $item->product->name);
                    OrderItem::create([
                        'order_id' => $order->id,
                        'product_id' => $item->product_id,
                        'product_name' => $item->product->name,
                        'price' => $item->product->price,
                        'quantity' => $item->quantity,
                    ]);
                }
                //order address data
                foreach ($request->post('addr') as $type => $address)
                {
//                    $address['type'] = $type;
//                    $order->addresses()->create($address);
                }
            }

            //$cart->empty();
            DB::commit();

            //event('order.created' , $order , Auth::user());
            event(new OrderCreated($order));

        } catch ( \Throwable $e){
            DB::rollBack();
            throw $e;
        }

        return redirect()->route('home');
    }



}
