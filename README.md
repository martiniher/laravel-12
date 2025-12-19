# Testing

El testing asegura que, al realizar cambios en el futuro, las funcionalidades existentes no se rompan. Para lograrlo, Laravel divide las pruebas en dos categorías principales: *Unit* (unitarios) y *Feature* (funcionalidad). Para realizar estos tests utilizaremos *Pest*, que se ha convertido en el estándar moderno de Laravel gracias a su sintaxis elegante y minimalista.

## Unitarios (Unit)

Prueba una función o clase pequeña en aislamiento. Son extremadamente rápidos porque no cargan el framework ni tocan la base de datos.

```bash
php artisan make:test PriceCalculatorTest --unit
```

Ejemplo de servicio a testear.

```php
// app\Services\PriceCalculator.php
namespace App\Services;

class PriceCalculator
{
    public function calculateTotal(float $price, float $taxRate = 0.21): float
    {
        return $price + ($price * $taxRate);
    }
}
```

Ejemplo de test unitarios.

```php
// tests\Unit\PriceCalculatorTest.php
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
```

## Funcionalidad (Feature)

Prueba una ruta entera, un controlador o un proceso completo. Simulan una petición HTTP, pasan por las rutas, controladores y validan cambios en la base de datos.

```bash
php artisan make:test FeatureExampleTest
```

Ejemplo de test de funcionalidad
```php
// 1. Define el nombre del test y la función que contiene la lógica.
// 'test' es una función global de Pest
test('the application returns a successful response', function () {

    // 2. Simula una petición HTTP de tipo GET a la ruta raíz ('/').
    // El resultado se guarda en la variable $response, que contiene todo el HTML y metadatos.
    $response = $this->get('/');

    // 3. Verifica que el código de estado de la respuesta sea exactamente 200 (OK).
    // Si la página diera un error 404 o 500, el test fallaría aquí mismo.
    $response->assertStatus(200);

    // 4. Extrae el HTML crudo de la respuesta ($response->getContent()) 
    // y usa la API de Pest (expect) para confirmar que el texto indicado está presente.
    // Esto asegura que, además de cargar, la página muestra el título correcto.
    expect($response->getContent())->toContain('<title>Laravel</title>');
});
```

## Comandos de ejecución
- Ejecutar todos los tests	`php artisan test`
- Ejecutar solo tests unitarios	`php artisan test --unit`
- Ejecutar solo el test que falló último	`php artisan test --retry`