<?php

namespace App\Payments\Methods;

use Alert;
use App\Models\Finance\Transaction;
use App\Payments\API\PayPal as PayPalApi;
use App\Payments\Contract\Payment;
use Illuminate\Http\Request;
use PayPal\Exception\PayPalConnectionException;

class PayPal implements Payment
{
    /**
     * Make a payment authorization request to PayPal.
     *
     * @param \App\Models\Finance\Transaction $transaction
     * @param string $itemName
     * @return \Illuminate\Http\Response
     */
    public function pay(Transaction $transaction, $itemName = '')
    {
        $payPal = new PayPalApi();

        $payment = $payPal->purchase([
            'name' => $itemName,
            'description' => $transaction->description,
            'amount' => (float)$transaction->amount,
            'returnUrl' => route('paypal-complete', ['reference' => $transaction->reference]),
            'cancelUrl' => route('paypal-cancel', ['reference' => $transaction->reference]),
        ]);

        try {
            $response = $payment->send();
            $gatewayDetails = new \stdClass();
            $gatewayDetails->gateway_reference = $response->getToken();

            $transaction->gateway_details = $gatewayDetails;
            $transaction->save();

            return $payPal->redirect();
        } catch (PayPalConnectionException $e) {
            $message = $e->getMessage();
            if (!is_null($e->getData())) {
                $message = $e->getData();
            }
            $transaction->failed();

            Alert::error(__('alert.error'), $message);

            return redirect()->back();
        }
    }

    /**
     * Complete or execute a PayPal payment.
     *
     * @param Request $request
     * @return \PayPal\Api\Payment
     */
    public function completePayment(Request $request)
    {
        $payPal = new PayPalApi();

        return $payPal->executePayment($request);
    }
}
