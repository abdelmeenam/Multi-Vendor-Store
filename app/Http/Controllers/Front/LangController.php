<?php

namespace App\Http\Controllers\Front;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Route;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;

class LangController extends Controller
{
    public function changeLanguage(Request $request)
    {
        //LaravelLocalization::getLocalizedURL("+ $( '#lang_selecto' ).val()+", null,[],true)

        $locale = $request->query('locale');
        //dd($locale);
         if (!in_array($locale,['ar','en','fr'])) {
            dd ('Invalid language code');
        }else{
             app()->setLocale($locale);
        }
        return redirect()->route(LaravelLocalization::getLocalizedURL($locale , null, [], true));
    }
}
