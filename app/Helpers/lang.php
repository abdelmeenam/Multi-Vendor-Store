<?php

namespace App\Helpers;



class Currency
{
    public function __invoke(...$params)
    {
        return static::format(...$params);
    }

    public static function format($amount, $currency = null)
    {

        //return $formatter->formatCurrency($amount, $currency);
    }
}
