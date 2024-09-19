<?php

use App\Http\Controllers\CardController;
use App\Http\Controllers\DeckController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');


Route::get('/hello', function(){
    return response()->json(['message' => 'hello world'], 200);
});




//Decks
Route::get('/decks', [DeckController::class, 'index']);
Route::post('/decks', [DeckController::class, 'create']);
Route::get('/decks/{deck}', [DeckController::class, 'show']);
Route::patch('/decks/{deck}', [DeckController::class, 'update']);
Route::delete('/decks/{deck}', [DeckController::class, 'delete']);

Route::get('/decks/{deck}/cards', [DeckController::class, 'getCards']);


Route::post('/decks/{deck}/cards', [CardController::class, 'createCard']);