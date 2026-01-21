<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\MatchingPair;
use App\Models\Card;
use Illuminate\Support\Facades\DB;

class MatchingPairSeeder extends Seeder
{
    public function run(): void
    {
        DB::transaction(function () {

            $matchingPair = MatchingPair::create([
                'name' => 'User',
                'game_over' => false,
                'mode' => 1, // easy
            ]);

            $cards = collect(range(1, 6))
                ->flatMap(fn ($pairId) => [
                    ['pair_id' => $pairId, 'value' => 'User'],
                    ['pair_id' => $pairId, 'value' => 'User'],
                ])
                ->shuffle()
                ->map(fn ($card) => [
                    'matching_pair_id' => $matchingPair->id,
                    'pair_id' => $card['pair_id'],
                    'value' => $card['value'],
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);

            Card::insert($cards->toArray());
        });
    }
}
