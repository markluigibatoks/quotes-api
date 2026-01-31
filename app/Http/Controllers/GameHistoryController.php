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
    public function index(Request $request)
    {
        $validated = $request->validate([
        'matching_pair_id' => ['required', 'integer'],
    ]);

        return new GameHistoryCollection(GameHistory::with('card.cardTemplate')->where('matching_pair_id', '=', $validated['matching_pair_id'])->get());
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

        if($previousFlip) {
            $previousCard = Card::findOrFail($previousFlip->card_id);
            $currentCard = Card::findOrFail($validated['card_id']);

            if($previousCard->position === $currentCard->position) {
                abort(409, 'Same card cannot be flipped twice.');
            }

            $currentFlip = GameHistory::create($validated);

            $isMatch = $previousCard->card_template_id === $currentCard->card_template_id;

            $previousFlip->update([
                'is_matched' => $isMatch,
                'matched_with' => $currentCard->id
            ]);

            $currentFlip->update([
                'is_matched' => $isMatch,
                'matched_with' => $previousCard->id
            ]);
        } else {
            $currentFlip = GameHistory::create($validated);
        }

        return new GameHistoryCollection(GameHistory::with('card.cardTemplate')->where('matching_pair_id', '=', $validated['matching_pair_id'])->get());
    }

    /**
     * Display the specified resource.
     */
    public function show(GameHistory $gameHistory)
    {
        return new GameHistoryResource($gameHistory->load('card.cardTemplate'));
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
