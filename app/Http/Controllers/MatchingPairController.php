<?php

namespace App\Http\Controllers;

use App\Http\Resources\MatchingPairCollection;
use App\Http\Resources\MatchingPairResource;
use App\Models\MatchingPair;
use App\Services\MatchingPair\GenerateCards;
use Illuminate\Http\Request;
use Spatie\QueryBuilder\AllowedInclude;
use Spatie\QueryBuilder\QueryBuilder;

class MatchingPairController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $sessions = QueryBuilder::for(MatchingPair::class)
            ->allowedIncludes(includes: [
                AllowedInclude::callback('cards', function ($query) {
                    return $query->orderBy('position');
                })
            ])
            ->allowedFilters(['game_over', 'difficulty'])
            ->allowedSorts(['id', 'name', 'game_over', 'difficulty'])
            ->paginate();

        return new MatchingPairCollection($sessions);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $generateCard = new GenerateCards();

        $validated = $request->validate([
            'name' => 'required|max:255',
            'difficulty' => 'required|integer|in:1,2,3'
        ]);

        $matchingPair = MatchingPair::create($validated);

        $pairCount = $matchingPair->difficulty * 2 + 4;

        $generateCard->handle($matchingPair->id, $pairCount);

        return new MatchingPairResource($matchingPair);
    }

    /**
     * Display the specified resource.
     */
    public function show(MatchingPair $matchingPair)
    {
        return new MatchingPairResource($matchingPair->load(['cards' => function ($query) {
        $query->orderBy('position', 'asc'); // sort by position
    }, 'cards.cardTemplate']));
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
