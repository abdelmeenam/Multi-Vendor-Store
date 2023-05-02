<?php

namespace App\View\Components;

use Illuminate\Routing\Route;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\Component;

class Nav extends Component
{
    public $items;
    //public $active;

    public function __construct()
    {
        //$this->items = config('nav');
        $this->items = $this->prepareItems(config('nav'));
       // $this->active = \Illuminate\Support\Facades\Route::currentRouteName();
    }

    public function render()
    {
        return view('components.nav');
    }

    protected function prepareItems($items){
        $user = Auth::user();
        //        $user = Auth::guard('admin')->user();
        foreach ($items as $key => $item) {
            if (isset($item['ability']) && !$user->can($item['ability'])) {
                unset($item[$key]);
            }
        }
        return $items;

    }
}
