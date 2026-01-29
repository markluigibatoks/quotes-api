<?php

namespace App\Http\Controllers;

use App\Http\Resources\GameHistoryCollection;
use App\Http\Resources\GameHistoryResource;
use App\Models\Card;
use App\Models\GameHistory;
use Illuminate\Http\Request;

class GameHistoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return new GameHistoryCollection(GameHistory::all());
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'card_id' => 'required|integer',
            'matching_pair_id' => 'required|integer'
        ]);
        
        $previousFlip = GameHistory::where('matching_pair_id', $validated['matching_pair_id'])->where('is_matched', false)->whereNull('matched_with')->latest('created_at')->first();

        $currentFlip = GameHistory::create($validated);

        if($previousFlip) {
            $isMatch = Card::find($previousFlip->card_id)->card_template_id === Card::find($currentFlip->card_id)->card_template_id;

            $previousFlip->update([
                'is_matched' => $isMatch,
                'matched_with' => $currentFlip->card_id
            ]);

            $currentFlip->update([
                'is_matched' => $isMatch,
                'matched_with' => $previousFlip->card_id
            ]);
        }

        return new GameHistoryResource($currentFlip->load('card.cardTemplate'));
    }

    /**
     * Display the specified resource.
     */
    public function show(GameHistory $gameHistory)
    {
        return new GameHistoryResource($gameHistory);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, GameHistory $gameHistory)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(GameHistory $gameHistory)
    {
        //
    }
}
