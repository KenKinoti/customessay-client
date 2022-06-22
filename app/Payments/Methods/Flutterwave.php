<?php

namespace App\Payments\Methods;

use App\Models\Finance\Transaction;
use App\Payments\Contract\Payment;
use Exception;
use KingFlamez\Rave\Facades\Rave as FlutterwavePayment;
use RealRashid\SweetAlert\Facades\Alert;

class Flutterwave implements Payment
{
    public function pay(Transaction $transaction, $itemName = '')
    {
        $reference = FlutterwavePayment::generateReference();

        $data = [
            'payment_options' => 'card,banktransfer',
            'amount' => $transaction->amount,
            'tx_ref' => $reference,
            'currency' => "USD",
            'redirect_url' => route('flutterwave.callback'),
            'customer' => [
                'email' => $transaction->user->email,
                "phone_number" =>  $transaction->user->phone_number,
                "name" =>  $transaction->user->name
            ],
            "customizations" => [
                "title" => 'Order Payment',
                "description" => $transaction->attachable->topic
            ]
        ];

        $payment = FlutterwavePayment::initializePayment($data);

        if ($payment['status'] !== 'success') {
            Alert::error(__('alert.error'), $payment['message']);

            return redirect()->back();
        }

        $gatewayDetails = new \stdClass();
        $gatewayDetails->gateway_reference = $reference;
        $transaction->gateway_details = $gatewayDetails;
        $transaction->save();

        return redirect($payment['data']['link']);
    }
}
