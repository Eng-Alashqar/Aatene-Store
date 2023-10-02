<?php

namespace App\Helpers;

class OrderTotal
{
    public static function calculateTotalCost($product){
        return $product->price;
    }
}
