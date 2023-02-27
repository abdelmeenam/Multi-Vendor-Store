<?php

namespace App\View\Components;

use Illuminate\Routing\Route;
use Illuminate\View\Component;

class Nav extends Component
{
    public $items;
    //public $active;

    public function __construct()
    {
        $this->items = config('nav');
       // $this->active = \Illuminate\Support\Facades\Route::currentRouteName();
    }

    public function render()
    {
        return view('components.nav');
    }
}
