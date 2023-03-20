<?php

namespace App\Facades;

use App\Repositories\Cart\CartRepository;
use Facade;

class Cart extends Facade
{
    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor()
{
    return CartRepository::class;
}
}
