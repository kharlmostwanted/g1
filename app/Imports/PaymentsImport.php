<?php

namespace App\Imports;

use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\SkipsOnError;
use Illuminate\Support\Carbon;
use App\Models\Household;
use App\Models\Payment;
use App\Models\Item;

class PaymentsImport implements ToModel, WithHeadingRow, SkipsOnError
{
    /**
     * model
     *
     * @param  mixed $row
     * @return void
     */
    public function model(array $row)
    {
        $household = Household::where('block', $row["block"])
            ->where('lot', $row["lot"])->first();
        $item = Item::where('title', 'monthly due')->first();

        if (!empty($household)) {
            $startDate = Carbon::parse('July last year')->startOfMonth();
            $endDate = Carbon::create('June this year')->endOfMonth();
            $dueAt = $startDate->copy();
            while ($dueAt->lte($endDate)) {
                $amount = !empty($row["md" . $dueAt->format('my')]) ? $row["md" . $dueAt->format('my')] : 0;

                if ($amount > 0) {
                    $payment = Payment::firstOrCreate([
                        'household_id' => $household->id,
                        'item_id' => $item->id,
                        'amount' => $amount,
                        'created_at' => $dueAt->endOfMonth(),
                    ]);
                }

                $dueAt->addMonth()->addDay(-5); // Move to the next month
            }
        }
    }

    /**
     * onError
     *
     * @param  mixed $e
     * @return void
     */
    public function onError(\Throwable $e)
    {
        // Handle the exception how you'd like.
    }
}
