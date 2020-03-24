<?php

use Illuminate\Http\Request;
use App\Http\Resources\Persona as PersonaResource;
use App\Models\Persona;

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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('/persona', function () {
    return new PersonaResource(Persona::find(2));
});