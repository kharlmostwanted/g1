<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Item;

class ItemsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Item::firstOrCreate([
            'title' => 'Monthly Due',
        ]);

        Item::firstOrCreate([
            'title' => 'Membership Fee',
        ]);

        Item::firstOrCreate([
            'title' => 'Vehicle Sticker',
        ]);
    }
}
