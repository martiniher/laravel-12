<?php

use App\Services\PriceCalculator;

test('calcula el precio total con el IVA del 21%', function () {
    // 1. Preparación (Arrange)
    $calculator = new PriceCalculator();

    // 2. Acción (Act)
    $result = $calculator->calculateTotal(100);

    // 3. Aserción (Assert)
    expect($result)->toBe(121.0);
});

test('puede calcular el total con un IVA personalizado', function () {
    $calculator = new PriceCalculator();
    
    // Probamos con un IVA del 10%
    $result = $calculator->calculateTotal(100, 0.10);
    
    expect($result)->toBe(110.0);
});