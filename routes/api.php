<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\GameApiController;

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


Route::get('games', [GameApiController::class, 'index']);
Route::get('games/{id}', [GameApiController::class, 'find']);
Route::post('games', [GameApiController::class, 'add']);
Route::put('games/{id}', [GameApiController::class, 'update']);
Route::delete('games/{id}', [GameApiController::class, 'delete']);

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});
