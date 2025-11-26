```php
// app\Providers\AppServiceProvider.php

use Illuminate\Support\Facades\Gate;

public function boot(): void
{
    // ...
    // Define un Gate llamado 'view-profile'
    Gate::define('view-profile', function ($user) {
        // En este caso simple, solo verifica si el usuario existe (está logueado).
        // En casos reales, podrías poner lógica más compleja aquí (ej: $user->isAdmin).
        return (bool) $user;
    });
}
```
creamos una nueva migracion
```bash
php artisan make:migration add_is_admin_to_users_table --table=users
```
Actualizamos la base de datos
```bash
php artisan migrate
```

```bash
php artisan make:controller ProfileController
```