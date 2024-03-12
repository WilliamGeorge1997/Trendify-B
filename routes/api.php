<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdController;
use App\Http\Controllers\AdImageController;

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});



// Route::get('/ads',function() {
//     return 'this is ads api';
// }) ;
Route::get('ads', [AdController::class, 'index']) ;
Route::post('ads', [AdController::class, 'store']);
Route::get('ads/{ad}', [AdController::class, 'show']);
Route::get('ads/{ad}/edit', [AdController::class, 'edit']);
Route::put('ads/{ad}/edit', [AdController::class, 'update']);
Route::delete('ads/{ad}/delete', [AdController::class, 'destroy']);

Route::get('/ads/{ad_id}/images', [AdImageController::class, 'index']);
Route::post('/ads/{ad_id}/images', [AdImageController::class, 'store']);
Route::get('/ads/{ad_id}/images/{image_id}', [AdImageController::class, 'show']);
Route::put('/ads/{ad_id}/images/{image_id}', [AdImageController::class, 'update']);
Route::delete('/ads/{ad_id}/images/{image_id}', [AdImageController::class, 'destroy']);
