<?php

namespace App\Models\Finance;

use App\Models\Finance\WalletTransaction as Transaction;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Wallet extends Model
{
    /**
     * Get current user wallet details.
     *
     * @param $query
     * @return mixed
     */
    public function scopeMyWallet($query)
    {
        return $query->where('user_id', Auth::user()->id)->first();
    }

    /**
     * Add funds to the wallet.
     *
     * @param $amount
     * @return bool
     */
    public function credit($amount)
    {
        $this->balance += $amount;

        return $this->save();
    }

    /**
     * Remove funds from the wallet.
     *
     * @param $amount
     * @return bool
     */
    public function debit($amount)
    {
        $this->balance -= $amount;

        return $this->save();
    }

    /**
     * Wallet transactions.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function transactions()
    {
        return $this->hasMany(Transaction::class);
    }
}
