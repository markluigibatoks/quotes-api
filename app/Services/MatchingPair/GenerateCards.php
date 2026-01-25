<?php

namespace App\Services\MatchingPair;

use App\Models\Card;
use App\Models\CardTemplate;

class GenerateCards
{
    public function handle(int $matchingPairId, int $pairCount) {

      $cardTemplates = CardTemplate::inRandomOrder()->limit($pairCount)->get();
        
        $cards = [];

        foreach($cardTemplates as $template) {
            $pairNumber = random_int(1000, 9999);

            $cards[] = [
                'pair_number' => $pairNumber,
                'position' => 0,
                'matching_pair_id' => $matchingPairId,
                'card_template_id' => $template->id    
            ];

            $cards[] = [
                'pair_number' => $pairNumber,
                'position' => 0,
                'matching_pair_id' => $matchingPairId,
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
    }
}
