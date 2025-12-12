<?php

namespace App\Services;

class ExampleService
{
    public function checkSuccess(array $data)
    {
        // Aquí iría tu lógica:

        return [
            'status' => 'success',
            'message' => 'Order processed successfully.',
            'data' => $data
        ];
    }
}