<?php

namespace Database\Seeders;

use App\Models\Household;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Carbon;
use App\Models\Payable;
use App\Models\Item;

class PayablesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $startDate = Carbon::create(now()->year - 1, 7, 1); // Start from July of last year
        $endDate = Carbon::create(now()->year, 6, 1)->endOfMonth(); // End in June of this year

        $dueAt = clone $startDate;
        $item = Item::where('title', 'monthly due')->first();

        while ($dueAt->lte($endDate)) {
            Household::lazy()->each(function ($household) use ($dueAt, $item) {
                Payable::updateOrCreate([
                    'household_id' => $household->id,
                    'item_id' => $item->id,
                    'amount' => 350,
                    'due_at' => $dueAt->endOfMonth(),
                ]);
            });

            $dueAt->addMonth()->addDay(-5); // Move to the next month
        }
    }
}
