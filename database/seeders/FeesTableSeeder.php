<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Carbon;
use App\Models\Fee;

class FeesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $startDate = Carbon::create(now()->year - 1, 7, 1); // Start from July of last year
        $endDate = Carbon::create(now()->year, 6, 1)->endOfMonth(); // End in June of this year

        $dueAt = clone $startDate;
        $amount = 350;
        $title = "Monthly Due";

        while ($dueAt->lte($endDate)) {
            Fee::firstOrCreate([
                'due_at' => $dueAt->endOfMonth(),
                'amount' => $amount,
                'title' => $dueAt->format('M Y') . ' ' . $title ,
            ]);

            $dueAt->addMonth()->addDay(-5); // Move to the next month
        }
    }
}
