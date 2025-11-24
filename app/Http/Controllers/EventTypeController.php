<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;

use Illuminate\Support\Facades\Validator;

use App\Models\EventType;

class EventTypeController extends Controller
{
    public function listTypes(): JsonResponse
    {
        $events = EventType::all();
        return response()->json(['message'=>null,'data'=>$events],200);
    }

    public function store(Request $request): JsonResponse
    {
        $validator = Validator::make($request->all(), [
            // El campo 'country' es obligatorio, debe ser texto y no exceder los 255 caracteres.
            'description' => 'required|string|max:255', 
        ]);
        
        if($validator->fails()){
            //return response()->json($validator->messages(), 400);
            return response()->json(['error' => $validator->errors()], 401);
        }
        
        $eventType = EventType::create([
            'description' => $request->get('description'),
        ]);

        return response()->json(['message'=>'Event Type Created','data'=>$eventType],200);
    }
}
