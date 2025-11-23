<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\JsonResponse;

use App\Models\Address;

class AddressController extends Controller
{
    public function store(Request $request): JsonResponse
    {
        $validator = Validator::make($request->all(), [
            // El ID del usuario asociado a esta dirección.
            // Debe ser un número entero que exista en tu tabla 'users'.
            'user_id' => 'required|integer|exists:users,id', 
            
            // El campo 'country' es obligatorio, debe ser texto y no exceder los 255 caracteres.
            'country' => 'required|string|max:255', 
            
            // El campo 'zipcode' es obligatorio, debe ser texto y no exceder los 255 caracteres.
            'zipcode' => 'required|string|max:5', 
        ]);
        if($validator->fails()){
            //return response()->json($validator->messages(), 400);
            return response()->json(['error' => $validator->errors()], 401);
        }
        $user = Address::create([
            'user_id' => $request->get('user_id'),
            'country' => $request->get('country'),
            'zipcode' => $request->get('zipcode'),
        ]);
        return response()->json(['message'=>'Address Created','data'=>$user],200);
    }

    public function show(Address $address): JsonResponse
    {
        return response()->json(['message'=>'','data'=>$address],200);
    }
    
    public function show_address(Address $address): JsonResponse
    {
        return response()->json(['message'=>'','data'=>$address->user()],200);
    }
}
