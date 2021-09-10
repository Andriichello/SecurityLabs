<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('/one/generate', function (Request $request) {
    $generator = new \App\Labs\One\Generator($request->query());
    $generated = $generator->iterator($request->query('amount', 10));

    return [
        'period' => $generator->period(),
        'values' => iterator_to_array($generated),
        'options' => $generator->options(),
    ];
});
