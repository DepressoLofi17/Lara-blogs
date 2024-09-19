<?php

namespace App\Http\Controllers;

use Exception;
use App\Models\Deck;
use Illuminate\Http\Request;

class DeckController extends Controller
{
    //CRUD
    public function index(){
        $decks = Deck::get();
            return response()->json([
                'status' => 'success',
                'decks' => $decks
            ], 200);
    }


    public function create(Request $request){
        try{
            $validatedData = $request->validate([
                'user_id' => 'required|exists:users,id',
                'title' => 'required|string',
                'description' => 'nullable|string'
            ]);
            //TODO:: user id in validation is temporary, it need to be  used with user jwt
            $deck = Deck::create($validatedData);

            return response()->json([
                'status' => 'sucess',
                'deck' => $deck
            ], 200);
        } catch (Exception $e){
            return response()->json([
                'status' => 'error',
                'error' => $e->getMessage()
            ], 500);
        }
    }


    public function show(Deck $deck) {
        return response()->json([
            'status' => 'success',
            'deck' => $deck
        ], 200);
    }


    public function update(Request $request, Deck $deck){
        try{
            $validatedData = $request->validate([
                'title' => 'required|string',
                'description' => 'nullable|string'
            ]);
            $deck->update($validatedData);

            return response()->json([
                'status' => 'success',
                'deck' => $deck
            ], 200);
        } catch (Exception $e){
            return response()->json([
                'status' => 'error',
                'error' => $e->getMessage()
            ], 500);
        }
    }


    public function delete(Deck $deck){
        try{
            $deck->delete();
            return response()->json([
                'status' => 'success',
                'message' => 'Deck deleted successfully'
            ], 200);
        } catch (Exception $e){
            return response()->json([
                'status' => 'error',
                'error' => $e->getMessage()
            ], 500);
        }
    }


    public function getCards(Deck $deck){
        $cards = $deck->cards()->get();

        return response()->json([
            'status' => 'success',
            'cards' => $cards
        ], 200);
    }

}
