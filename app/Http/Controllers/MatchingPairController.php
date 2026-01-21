<?php

namespace App\Http\Controllers;

use App\Http\Resources\MatchingPairCollection;
use App\Http\Resources\MatchingPairResource;
use App\Models\MatchingPair;
use Illuminate\Http\Request;

class MatchingPairController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return new MatchingPairCollection(MatchingPair::all());
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(MatchingPair $matchingPair)
    {
        //
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
