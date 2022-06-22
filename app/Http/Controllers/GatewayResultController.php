<?php

namespace App\Http\Controllers;

use App\Events\Orders\OrderCompleted;
use App\Models\Finance\Transaction;
use App\Models\Finance\Wallet;
use App\Models\Finance\WalletTransaction;
use App\Payments\Methods\PayPal;
use Illuminate\Http\Request;
use KingFlamez\Rave\Facades\Rave as Flutterwave;
use PayPal\Exception\PayPalConnectionException;
use RealRashid\SweetAlert\Facades\Alert;

class GatewayResultController extends Controller
{
    /**
     * Complete a PayPal Transaction.
     *
     * @param Request $request
     * @return \Illuminate\Http\Response
     */
    public function payPalComplete(Request $request)
    {
        $this->validate($request, ['token' => 'required', 'paymentId' => 'required', 'PayerID' => 'required']);

        $payPal = new PayPal();
        $transaction = Transaction::where('gateway_details->gateway_reference', $request->token)->firstOrFail();

        try {
            $payment = $payPal->completePayment($request);
            $gatewayDetails = $transaction->gateway_details;
            $gatewayDetails->sale_id = $payment->transactions[0]->related_resources[0]->sale->id;
            $gatewayDetails->gateway_payment_id = $request->paymentId;
            $gatewayDetails->gateway_payer_id = $request->PayerID;

            $transaction->gateway_details = $gatewayDetails;
            $transaction->complete();

            return $this->completeTransaction($transaction);
        } catch (PayPalConnectionException $e) {
            $message = $e->getMessage();

            if (!is_null($e->getData())) {
                $message = json_decode($e->getData())->message;
            }
            $transaction->failed();

            Alert::error(__('alert.error'), $message);

            if ($transaction->attachable instanceof Wallet) {
                return redirect(route('wallet'));
            }

            return redirect(route('orders.pending'));
        }
    }

    /**
     * Complete a Transaction.
     *
     * @param Transaction $transaction
     * @return \Illuminate\Http\Response
     */
    public function completeTransaction(Transaction $transaction)
    {
        if ($transaction->attachable instanceof Wallet) {
            $wallet = $transaction->attachable;
            $wallet->credit($transaction->amount);
            $wallet->transactions()->create([
                'reference' => $transaction->reference,
                'description' => 'Wallet deposit',
                'amount' => $transaction->amount,
                'type' => 'c',
                'status' => WalletTransaction::COMPLETE,
            ]);

            Alert::success(__('alert.success'), __('wallet.credit'));

            return redirect(route('wallet'));
        }

        $transaction->attachable->paid();

        event(new OrderCompleted($transaction->attachable));

        Alert::success(__('alert.success'), __('order.success'));

        return redirect(route('orders.pending'));
    }

    /**
     * When a transaction gets cancelled.
     *
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function payPalCancel(Request $request)
    {
        $transaction = Transaction::where('gateway_details->gateway_reference', $request->token)->firstOrFail();
        $transaction->cancelled();

        Alert::warning(__('alert.cancelled'), __('transaction.cancelled'));

        event(new OrderCompleted($transaction->attachable));

        if ($transaction->attachable instanceof Wallet) {
            return redirect(route('wallet'));
        }

        return redirect(route('orders.pending'));
    }

    public function flutterwave()
    {
        $status = request()->status;

        if ($status == 'successful') {
            $transactionID = Flutterwave::getTransactionIDFromCallback();
            $data = Flutterwave::verifyTransaction($transactionID);
            $transaction = Transaction::where('gateway_details->gateway_reference', request()->tx_ref)->firstOrFail();

            $gatewayDetails = $transaction->gateway_details;
            $gatewayDetails->flw_ref = $data['data']['flw_ref'];
            $gatewayDetails->payment_type = $data['data']['payment_type'];
            $transaction->gateway_details = $gatewayDetails;
            $transaction->complete();

            return $this->completeTransaction($transaction);
        } elseif ($status == 'cancelled') {
            $transaction = Transaction::where('gateway_details->gateway_reference', request()->tx_ref)->firstOrFail();
            $transaction->cancelled();

            Alert::warning(__('alert.cancelled'), __('transaction.cancelled'));

            event(new OrderCompleted($transaction->attachable));

            if ($transaction->attachable instanceof Wallet) {
                return redirect(route('wallet'));
            }

            return redirect(route('orders.pending'));
        } else {
            $transaction = Transaction::where('gateway_details->gateway_reference', request()->tx_ref)->firstOrFail();
            $transaction->failed();

            Alert::warning(__('alert.failed'), __('transaction.failed'));

            event(new OrderCompleted($transaction->attachable));

            if ($transaction->attachable instanceof Wallet) {
                return redirect(route('wallet'));
            }

            return redirect(route('orders.pending'));
        }
    }
}
