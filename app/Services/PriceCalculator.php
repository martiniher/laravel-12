<?php

namespace App\Services;

class PriceCalculator
{
    public function calculateTotal(float $price, float $taxRate = 0.21): float
    {
        return $price + ($price * $taxRate);
    }
}