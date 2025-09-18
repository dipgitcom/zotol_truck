<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;


// Home
Route::get('/', function () {
    return view('welcome');
});



require __DIR__.'/auth.php';
require __DIR__.'/backend.php';
// require __DIR__.'/api.php';