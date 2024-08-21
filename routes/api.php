<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Models\Product;

Route::get('/prices', function() {
    $prices = [];
    foreach(Product::allowedMetals() as $metal => $metalName)
        $prices[$metal] = fake()->randomFloat(2, 10, 150);
    return response()->json($prices);
});
