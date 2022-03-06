<?php

namespace Database\Seeders;

use App\Models\Currency;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CurrencySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Currency::insert([
            [
                'code' => 'copper',
                'name' => 'Copper',
                'base_value' => 1,
                'short_hand' => 'cp',
            ],
            [
                'code' => 'silver',
                'name' => 'Silver',
                'base_value' => 10,
                'short_hand' => 'sp',
            ],
            [
                'code' => 'electrum',
                'name' => 'Electrum',
                'base_value' => 50,
                'short_hand' => 'ep',
            ],
            [
                'code' => 'gold',
                'name' => 'Gold',
                'base_value' => 100,
                'short_hand' => 'gp',
            ],
            [
                'code' => 'platinum',
                'name' => 'Platinum',
                'base_value' => 1000,
                'short_hand' => 'pp',
            ],
        ]);
    }
}
