<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\JogoController;

Route::get('/', function(){
    return response()->json([
        'sucess' => true
    ]);
});

Route::get('/jogo',[JogoController::class,'index']);
Route::get('/jogo/{id}',[JogoController::class,'show']);
Route::post('/jogo',[JogoController::class,'store']);
Route::delete('/jogo/{id}',[JogoController::class,'destroy']);
Route::put('/jogo/{id}',[JogoController::class,'update']);
