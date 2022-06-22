<?php

namespace App\Payments;

use Alert;
use App\Models\Finance\Transaction;
use App\Payments\Methods\Flutterwave;
use App\Payments\Methods\PayPal;
use App\Payments\Methods\Wallet;

class PaymentGateway
{
    /**
     * The selected payment method.
     *
     * @var string
     */
    protected $paymentMethod;

    /**
     * PaymentGateway constructor.
     *
     * @param $paymentMethod
     */
    public function __construct($paymentMethod)
    {
        $this->paymentMethod = $paymentMethod;
    }

    /**
     * Make payment with the selected payment method.
     *
     * @param \App\Models\Finance\Transaction $transaction
     * @param string $itemName
     * @return \Illuminate\Http\Response
     */
    public function makePayment(Transaction $transaction, $itemName = '')
    {
        switch ($this->paymentMethod) {
            case 'paypal':
                $payPal = new PayPal();

                return $payPal->pay($transaction, $itemName);
            case 'flutterwave':
                $flutterwave = new Flutterwave();

                return $flutterwave->pay($transaction, $itemName);
            case 'wallet':
                $wallet = new Wallet();

                return $wallet->pay($transaction, $itemName);
            default:
                return $this->methodNotFound();
        }
    }

    /**
     * Take the user to the orders page if payment method is not
     * recognized.
     *
     * @return \Illuminate\Http\Response
     */
    protected function methodNotFound()
    {
        Alert::error("Error", 'Payment method not supported.');

        return redirect(route('orders.pending'));
    }
}
