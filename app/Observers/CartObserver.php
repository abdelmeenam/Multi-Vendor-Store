<?php

namespace App\Observers;

use App\Models\cart;
use Illuminate\Support\Str;

class CartObserver
{
    /**
     * Handle the cart "creating" event.
     *
     * @param  \App\Models\cart  $cart
     * @return void
     */
    public function creating(cart $cart)
    {
        $cart->id = Str::uuid();
        $cart->cookie_id = cart::getCookieId();
    }

}
