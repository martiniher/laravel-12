<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

use Illuminate\Http\JsonResponse;

use App\Models\Event;

class EventController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request): JsonResponse
    {
        
        $validator = Validator::make($request->all(), [
            'event_name' => 'required|string|max:255',
            'event_detail' => 'required|string|max:255',
        ]);

        if($validator->fails()){
            return response()->json($validator->messages(), 400);
        }

        $event = Event::create([
            'event_name' => $request->get('event_name'),
            'event_detail' => $request->get('event_detail'),
        ]);
        
        return response()->json(['message'=>'Event Created','data'=>$event],200);
        
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }

    public function listUsers(Event $event)
    {
        $users = $event->users;
        return response()->json(['message'=>null,'data'=>$users],200);
    }

}
