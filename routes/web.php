<?php

use Illuminate\Support\Facades\Route;



Route::get('/', function () {
    return view('app');
});

Route::get('/admin', function () {
    return view('admin');
});
