



```bash
php artisan make:migration create_events_table
php artisan make:migration create_event_user_table
```

```php
// database\migrations\2025_11_24_065916_create_events_table.php

public function up()
{
    Schema::create('events', function (Blueprint $table) {
        $table->id();
        $table->string('event_name');
        $table->string('event_detail')->nullable();
        $table->timestamps();
    });
}
```

```php
// database\migrations\2025_11_24_070028_create_event_user_table.php

public function up()
{
    Schema::create('event_user', function (Blueprint $table) {
        $table->primary(['user_id','event_id']);
        $table->bigInteger('user_id')->unsigned();
        $table->bigInteger('event_id')->unsigned();
        $table->string('note');
        $table->timestamps();
        $table->foreign('user_id')
        ->references('id')
        ->on('users');
        $table->foreign('event_id')
        ->references('id')
        ->on('events');
    });
}
```

```bash
php artisan migrate
```

```bash
php artisan make:model Event
```

```php
//app\Models\Event.php

class Event extends Model
{
    protected $fillable = [
        'event_name', 'event_detail',
    ];

    public function users(){
        return $this->belongsToMany('App\Models\User')->withTimestamps();
    }

    /*
    public function eventType(){
    return $this->belongsTo('App\Models\EventType');
    }
    */
}
```

```php
//app\Models\User.php

public function events()
{
    return $this->belongsToMany('App\Models\Event')->withPivot('note')->withTimestamp();
}
```

```php
//app\Http\Controllers\UserController.php

    public function bookEvent(Request $request): JsonResponse
    {
        $validator = Validator::make($request->all(), [
            'user_id' => 'required|int',
            'event_id' => 'required|int',
        ]);

        if( $validator->fails()){
            return response()->json($validator->messages(), 400);
        }

        $note = '';

        if($request->note) {
            $note = $request->note;
        }

        try {
            $user= User::where( 'id', $request->get('user_id'))->firstOrFail();
            $event= Event::where( 'id', $request->get('event_id'))->firstOrFail();
            if($user->events()->save($event, array('note' => $note))){
                return response()->json(['message'=>'User Event Created','data'=>$event],200);
            } else {
                throw new \Exception('Error al intentar guardar.');
            }
        } catch (\Exception $exception) {
            return response()->json($exception->getMessage(), 400);
        }
    }

    public function listEvents(User $user= null): JsonResponse
    {
        if($user){
            $events = $user->events;
            return response()->json(['message'=>null,'data'=>$events],200);
        }
        return response()->json(['message'=>'User not Found'],404);
    }
```

```php
//app\Models\User.php

    public function listUsers(Event $event)
    {
        $users = $event->users;
        return response()->json(['message'=>null,'data'=>$users],200);
    }
```
