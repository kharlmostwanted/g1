<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Household extends Model
{
    use HasFactory;

    public function __toString()
    {
        return $this->title;
    }

    public function owner(): BelongsTo
    {
        return $this->belongsTo(User::class, 'owner_id');
    }

    public function payables()
    {
        return $this->hasMany(Payable::class);
    }

    public function payments()
    {
        return $this->hasMany(Payment::class);
    }

    public function getIsGoodStandingAttribute()
    {
        return $this->payables()
            ->where('due_at', '<', now())
            ->whereRelation('item', 'title', 'Monthly Due')
            ->sum('amount') <= $this->payments()
            ->whereRelation('item', 'title', 'Monthly Due')
            ->sum('amount');
    }

    public function getTitleAttribute()
    {
        return 'Block ' . $this->block . ' Lot ' . $this->lot;
    }

    public function getTransactionsAttribute()
    {
        $transactions =  $this->payables()
            ->where('due_at', '<', now())
            ->whereRelation('item', 'title', 'Monthly Due')
            ->withCasts(['due_at' => 'datetime'])
            ->get()->map(function ($payable) {
                return [
                    'id' => $payable->id,
                    'title' => $payable->item->title,
                    'debit' => $payable->amount,
                    'credit' => 0,
                    'date' => $payable->due_at,
                ];
            });

        $transactions = $transactions->merge(
            $this->payments()
                ->whereRelation('item', 'title', 'Monthly Due')
                ->withCasts(['created_at' => 'datetime'])
                ->get()->map(function ($payment) {
                    return [
                        'id' => $payment->id,
                        'title' => $payment->item->title . ' Payment',
                        'debit' => 0,
                        'credit' => $payment->amount,
                        'date' => $payment->created_at,
                    ];
                })
        );

        return collect($transactions);
    }

    public function scopeUpdatedMonthlyDues($query, $asOf = null)
    {
        $asOf = $asOf ?? now();
        $item = Item::where('title', 'Monthly Due')->first();
        $query->addSelect([
            'total_payable'=> Payable::selectRaw('sum(amount)')
                ->whereColumn('household_id', 'households.id')
                ->where('item_id', $item->id)
                ->where('due_at', '<', $asOf),
            'total_payment'=> Payment::selectRaw('sum(amount)')
                ->whereColumn('household_id', 'households.id')
                ->where('item_id', $item->id)
        ])->havingRaw('total_payable <= total_payment');
    }

    public function scopeOutdatedMonthlyDues($query, $asOf = null)
    {
        $asOf = $asOf ?? now();
        $item = Item::where('title', 'Monthly Due')->first();
        $query->addSelect([
            'total_payable'=> Payable::selectRaw('sum(amount)')
                ->whereColumn('household_id', 'households.id')
                ->where('item_id', $item->id)
                ->where('due_at', '<', $asOf),
            'total_payment'=> Payment::selectRaw('sum(amount)')
                ->whereColumn('household_id', 'households.id')
                ->where('item_id', $item->id)
        ])->havingRaw('total_payable > total_payment');
    }
}
