<?php

namespace App\Accountant;

use App\Models\Finance\Wallet as UserWallet;
use App\Models\Finance\WalletTransaction as Transaction;
use Illuminate\Support\Facades\Auth;

class Wallet
{
    /**
     * Check whether the user wallet has sufficient funds to make a
     * transaction.
     *
     * @param float $amount
     * @param int|null $userId
     * @return bool
     */
    public static function hasSufficientFunds(float $amount, int $userId = null)
    {
        $wallet = self::getWallet($userId);

        return $amount <= $wallet->balance;
    }

    /**
     *  Debit a user wallet.
     *
     * @param float $amount
     * @param string $description
     * @param int|null $userId
     * @return \App\Models\Finance\WalletTransaction
     */
    public static function debit(float $amount, string $description, int $userId = null)
    {
        $wallet = self::getWallet($userId);
        $wallet->debit($amount);

        return $wallet->transactions()->create([
            'reference' => 'WAL'.now()->timestamp,
            'description' => $description,
            'amount' => $amount,
            'type' => 'd',
            'status' => Transaction::COMPLETE,
        ]);
    }

    /**
     * Debit a user wallet.
     *
     * @param float $amount
     * @param string $description
     * @param int|null $userId
     * @return \App\Models\Finance\WalletTransaction
     */
    public static function credit(float $amount, string $description, int $userId = null)
    {
        $wallet = self::getWallet($userId);
        $wallet->credit($amount);

        return $wallet->transactions()->create([
            'reference' => 'WAL'.now()->timestamp,
            'description' => $description,
            'amount' => $amount,
            'type' => 'c',
            'status' => Transaction::COMPLETE,
        ]);
    }

    /**
     * Get the specified user wallet.
     *
     * @param int|null $userId
     * @return \App\Models\Finance\Wallet
     */
    protected static function getWallet($userId)
    {
        return UserWallet::where('user_id', is_null($userId) ? Auth::user()->id : $userId)->first();
    }
}
