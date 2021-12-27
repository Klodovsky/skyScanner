<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LocationController;


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

Route::get('/forecast', function () {
    $apiKey = config('services.openweather.key');
    $url = 'https://api.openweathermap.org/data/2.5/weather';
    $city = request('q');
    $lat = request('lat');
    $lon = request('lon');
   // $response = Http::get("$url?lat=$lat&lon=$lon&appid=$apiKey&units=metric");
    return Http::get("$url?q=$city&appid=$apiKey&units=metric")->json();
});


Route::get('/get-user-location-data', [LocationController::class, 'index']);

