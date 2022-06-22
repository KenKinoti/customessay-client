<?php

namespace App\Payments\Contract;

use App\Models\Finance\Transaction;

interface Payment
{
    /**
     * Make a payment through specified gateway.
     *
     * @param \App\Models\Finance\Transaction $transaction
     * @param string $itemName
     * @return \Illuminate\Http\Response
     */
    public function pay(Transaction $transaction, $itemName = '');
}
