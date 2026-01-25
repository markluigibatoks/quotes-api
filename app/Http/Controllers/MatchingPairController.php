<?php

namespace App\Http\Controllers;

use App\Http\Resources\MatchingPairCollection;
use App\Http\Resources\MatchingPairResource;
use App\Models\Card;
use App\Models\CardTemplate;
use App\Models\MatchingPair;
use Illuminate\Http\Request;

class MatchingPairController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return new MatchingPairCollection(MatchingPair::with('cards')->get());
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|max:255',
            'difficulty' => 'required|integer'
        ]);

        $matchingPair = MatchingPair::create($validated);

        $cardTemplates = CardTemplate::inRandomOrder()->limit(6)->get();
        
        $cards = [];

        foreach($cardTemplates as $template) {
            $pairNumber = random_int(1000, 9999);

            $cards[] = [
                'pair_number' => $pairNumber,
                'position' => 0,
                'matching_pair_id' => $matchingPair->id,
                'card_template_id' => $template->id    
            ];

            $cards[] = [
                'pair_number' => $pairNumber,
                'position' => 0,
                'matching_pair_id' => $matchingPair->id,
                'card_template_id' => $template->id    
            ];
        }

        // Randomize positions 1–12
        $positions = range(1, count($cards));
        shuffle($positions);
        
        foreach($cards as $index => &$card) {
            $card['position'] = $positions[$index];
        }

        Card::insert($cards);

        return new MatchingPairResource($matchingPair);
    }

    /**
     * Display the specified resource.
     */
    public function show(MatchingPair $matchingPair)
    {
        return new MatchingPairResource($matchingPair->load('cards'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, MatchingPair $matchingPair)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(MatchingPair $matchingPair)
    {
        //
    }
}
