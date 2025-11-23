
php artisan make:migration create_addresses_table

php artisan migrate:refresh

php artisan make:model Address

```php
// app\Models\User.php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    //Otros métodos ...

    public function address(){
        return $this->hasOne('App\Models\Address');
    }
}
```

```php
    // app\Models\Address.php

    namespace App\Models;

    use Illuminate\Database\Eloquent\Model;

    class Address extends Model
    {
        public function user(){
            return $this->belongsTo('App\Models\User');
        }
    }
```

```bash
php artisan install:api
php artisan make:controller UserController
php artisan make:controller AddressController
```

```php

// routes\api.php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\AddressController;
use App\Http\Controllers\UserController;

Route::controller(UserController::class)->group(function(){
    Route::post('register', 'register');
    Route::get('user/{user}', 'show');
    Route::get('user/{user}/address', 'show_address');
});

Route::controller(AddressController::class)->group(function() {
    Route::post('address', 'store');
    Route::get('address/{address}', 'show');
    Route::get('address/{address}/user', 'show_user');
});
```



