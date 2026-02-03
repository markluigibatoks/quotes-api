<?php

namespace App\Http\Controllers;

use App\Http\Resources\GameFlipLogCollection;
use App\Http\Resources\GameFlipLogResource;
use App\Http\Resources\MatchingPairResource;
use App\Models\Card;
use App\Models\GameFlipLog;
use App\Models\MatchingPair;
use Illuminate\Http\Request;

class GameFlipLogController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $validated = $request->validate([
            'matching_pair_id' => ['required', 'integer'],
        ]);

        return new MatchingPairResource(MatchingPair::with('gameFlipLogs.card.cardTemplate')->findOrFail($validated['matching_pair_id']));
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
        
        $previousFlip = GameFlipLog
        ::where('matching_pair_id', $validated['matching_pair_id'])
        ->whereHas('card', function ($query) {
            $query->where('is_matched', false);
        })
        ->whereNull('matched_with')
        ->latest('created_at')
        ->first();

        $currentFlip = GameFlipLog::create($validated);

        if($previousFlip) {
            $previousCard = Card::findOrFail($previousFlip->card_id);
            $currentCard = Card::findOrFail($validated['card_id']);

            if($previousCard->position === $currentCard->position) {
                abort(409, 'Same card cannot be flipped twice.');
            }

            $isMatch = $previousCard->card_template_id === $currentCard->card_template_id;

            //update Card
            $previousCard->update([
                'is_matched' => $isMatch,
            ]);

            $currentCard->update([
                'is_matched' => $isMatch,
            ]);

            //update flip log
            $previousFlip->update([
                'matched_with' => $currentCard->id
            ]);

            $currentFlip->update([
                'matched_with' => $previousCard->id
            ]);

            // Check if the game is over
            $hasUnmatched = Card::where('matching_pair_id', $validated['matching_pair_id'])->where('is_matched', false)->exists();

            if(!$hasUnmatched) {
                MatchingPair::where('id', $validated['matching_pair_id'])->update([
                    'game_over' => true
                ]);
            }
        }

        return new MatchingPairResource(MatchingPair::with('gameFlipLogs.card.cardTemplate')->findOrFail($validated['matching_pair_id']));
    }

    /**
     * Display the specified resource.
     */
    public function show(GameFlipLog $gameFlipLog)
    {
        return new GameFlipLogResource($gameFlipLog->load('card.cardTemplate'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, GameFlipLog $gameFlipLog)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(GameFlipLog $gameFlipLog)
    {
        //
    }
}
