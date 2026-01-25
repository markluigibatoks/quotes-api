<?php

namespace App\Http\Controllers;

use App\Http\Resources\CardTemplateResource;
use App\Models\CardTemplate;
use Illuminate\Http\Request;
use App\Http\Resources\CardTemplateCollection;

class CardTemplateController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return new CardTemplateCollection(CardTemplate::all());
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
    public function show(CardTemplate $cardTemplate)
    {
        return new CardTemplateResource($cardTemplate);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, CardTemplate $cardTemplate)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(CardTemplate $cardTemplate)
    {
        //
    }
}
