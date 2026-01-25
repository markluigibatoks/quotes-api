<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CardTemplateSeeder extends Seeder
{
    public function run(): void
    {
        $cards = [
            // Fruits
            ['value' => 'apple_red',     'category' => 'fruit'],
            ['value' => 'apple_green',   'category' => 'fruit'],
            ['value' => 'banana',        'category' => 'fruit'],
            ['value' => 'orange',        'category' => 'fruit'],
            ['value' => 'lemon',         'category' => 'fruit'],
            ['value' => 'lime',          'category' => 'fruit'],
            ['value' => 'watermelon',    'category' => 'fruit'],
            ['value' => 'grapes',        'category' => 'fruit'],
            ['value' => 'strawberry',    'category' => 'fruit'],
            ['value' => 'cherry',        'category' => 'fruit'],
            ['value' => 'pineapple',     'category' => 'fruit'],
            ['value' => 'pear',          'category' => 'fruit'],
            ['value' => 'peach',         'category' => 'fruit'],
            ['value' => 'melon',         'category' => 'fruit'],
            ['value' => 'kiwi',          'category' => 'fruit'],
            ['value' => 'mango',         'category' => 'fruit'],
            ['value' => 'blueberry',     'category' => 'fruit'],
            ['value' => 'coconut',       'category' => 'fruit'],

            // Vegetables
            ['value' => 'tomato',        'category' => 'vegetable'],
            ['value' => 'eggplant',      'category' => 'vegetable'],
            ['value' => 'avocado',       'category' => 'vegetable'],
            ['value' => 'chili_pepper',  'category' => 'vegetable'],
            ['value' => 'bell_pepper',   'category' => 'vegetable'],
        ];

        DB::table('card_templates')->insert($cards);
    }
}
