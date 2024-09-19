<?php

namespace App\Http\Controllers;

use Exception;
use App\Models\Card;
use App\Models\Deck;
use Illuminate\Http\Request;

class CardController extends Controller
{

    public function createCard(Request $request, Deck $deck){
    try {
        $validatedData = $request->validate([
            'question' => 'required|string',
            'answer' => 'required|string'
        ]);

        $card = new Card();
        $card->deck_id = $deck->id;
        $card->question = $validatedData['question'];
        $card->answer = $validatedData['answer'];
        $card->save();

        return response()->json([
            'status' => 'success',
            'card' => $card
        ]);

    } catch (Exception $e) {
        return response()->json([
            'status' => 'error',
            'error' => $e->getMessage()
        ]);
    }
}



}
