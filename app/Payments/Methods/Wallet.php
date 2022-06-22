<?php

namespace App\Payments\Methods;

use Alert;
use App\Events\Orders\OrderCompleted;
use App\Models\Configurations\PaymentMethod;
use App\Accountant\Wallet as UserWallet;
use App\Models\Finance\Transaction;
use App\Payments\Contract\Payment;
use Illuminate\Database\Eloquent\Model;

class Wallet implements Payment
{
    /**
     * Make the payment.
     *
     * @param \App\Models\Finance\Transaction $transaction
     * @param string $itemName
     * @return \Illuminate\Http\Response
     */
    public function pay(Transaction $transaction, $itemName = '')
    {
        if (UserWallet::hasSufficientFunds($transaction->amount)) {
            UserWallet::debit($transaction->amount,$transaction->description);

            return $this->completeTransaction($transaction);
        }

        Alert::error(__('alert.error'), __('wallet.insufficient'));

        return redirect(route('orders.pending'));
    }

    /**
     * Complete Transaction.
     *
     * @param Model $transaction
     * @return \Illuminate\Http\Response
     */
    public function completeTransaction($transaction)
    {
        $transaction->complete();
        $transaction->attachable->paid();

        event(new OrderCompleted($transaction->attachable));

        Alert::success(__('alert.success'), __('order.success'));

        return redirect(route('orders.pending'));
    }
}
