<?php

use App\Http\Controllers\CardController;
use App\Http\Controllers\CardTemplateController;
use App\Http\Controllers\MatchingPairController;
use App\Http\Controllers\QuoteController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');


Route::apiResource('quotes', QuoteController::class)->only(['index', 'show']);
Route::apiResource('cards', CardController::class)->only(['index', 'show']);
Route::apiResource('card-templates', CardTemplateController::class)->only(['index', 'show']);
Route::apiResource('matching-pairs', MatchingPairController::class);


// [
//   {
//     "quote": "Push yourself because no one else is going to do it for you.",
//     "author": "Unknown"
//   },
//   {
//     "quote": "No pain, no gain.",
//     "author": "Benjamin Franklin"
//   },
//   {
//     "quote": "Don’t limit your challenges. Challenge your limits.",
//     "author": "Jerry Dunn"
//   },
//   {
//     "quote": "The body achieves what the mind believes.",
//     "author": "Napoleon Hill"
//   },
//   {
//     "quote": "Sweat is fat crying.",
//     "author": "Unknown"
//   },
//   {
//     "quote": "Your only limit is you.",
//     "author": "Unknown"
//   },
//   {
//     "quote": "Strength does not come from winning. Your struggles develop your strengths.",
//     "author": "Arnold Schwarzenegger"
//   },
//   {
//     "quote": "Excuses don’t burn calories.",
//     "author": "Unknown"
//   },
//   {
//     "quote": "Great things never come from comfort zones.",
//     "author": "Unknown"
//   },
//   {
//     "quote": "Train insane or remain the same.",
//     "author": "Unknown"
//   }
// ]
