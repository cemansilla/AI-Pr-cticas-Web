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

Route::prefix('pyapi')->group(function () {
  Route::post('chat', [App\Http\Controllers\API\FastAPIController::class, 'chat']);
  Route::post('brainstorming', [App\Http\Controllers\API\FastAPIController::class, 'brainstorming']);
  Route::post('obsidian', [App\Http\Controllers\API\FastAPIController::class, 'obsidian']);
});