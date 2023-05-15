<?php

namespace App\Policies;

use App\Models\Product;
use Illuminate\Auth\Access\HandlesAuthorization;

class ProductPolicy extends ModelPolicy
{
    use HandlesAuthorization;

    public function view($user, Product $product) {
        return $user->hasAbility('products.view');
    }
}
