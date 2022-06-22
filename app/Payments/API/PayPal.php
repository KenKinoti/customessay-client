<?php

namespace App\Payments\API;

use App\Models\Configurations\Website;
use Illuminate\Http\Request;
use PayPal\Api\Amount;
use PayPal\Api\Item;
use PayPal\Api\ItemList;
use PayPal\Api\Payer;
use PayPal\Api\Payment;
use PayPal\Api\PaymentExecution;
use PayPal\Api\RedirectUrls;
use PayPal\Api\Transaction;
use PayPal\Auth\OAuthTokenCredential;
use PayPal\Rest\ApiContext;

class PayPal
{
    /**
     * @var ApiContext
     */
    protected $apiContext;

    /**
     * @var Payment
     */
    protected $payment;

    /**
     * @var string
     */
    protected $approvalLink;

    /**
     * PayPal constructor.
     */
    public function __construct()
    {
        $website = Website::findByName(config('app.name'));

        $mode = $website->payPalApiConfiguration->environment;
        $clientAttr = $mode.'_client';
        $secretAttr = $mode.'_secret';

        $clientId = $website->payPalApiConfiguration->$clientAttr;
        $secretKey = $website->payPalApiConfiguration->$secretAttr;

        $this->apiContext = new ApiContext(new OAuthTokenCredential($clientId, $secretKey));

        $config = [
            'mode' => $mode,
        ];

        // Enable Logs
        if (config('paypal.log.enabled')) {
            $config = array_merge($config, [
                'log.LogEnabled' => true,
                'log.FileName' => config('paypal.log.file_name'),
                'log.LogLevel' => config('paypal.log.level'),
            ]);
        }

        $this->apiContext->setConfig($config);
    }

    /**
     * Prepare the purchase details
     *
     * @param array $details
     * @return $this
     */
    public function purchase(array $details)
    {
        $payer = new Payer();
        $payer->setPaymentMethod('paypal');

        $item = new Item();
        $item->setName($details['name'])->setCurrency('USD')->setQuantity(1)->setPrice($details['amount']);

        $itemList = new ItemList();
        $itemList->setItems([$item]);

        $amount = new Amount();
        $amount->setTotal($details['amount']);
        $amount->setCurrency('USD');

        $transaction = new Transaction();
        $transaction->setItemList($itemList);
        $transaction->setDescription($details['description']);
        $transaction->setAmount($amount);

        $redirectUrls = new RedirectUrls();
        $redirectUrls->setReturnUrl($details['returnUrl'])->setCancelUrl($details['cancelUrl']);

        $payment = new Payment();
        $this->payment = $payment->setIntent('sale')->setPayer($payer)->setTransactions([$transaction])->setRedirectUrls($redirectUrls);

        return $this;
    }

    /**
     * Send the payment to PayPal
     *
     * @return mixed
     */
    public function send()
    {
        $response = $this->payment->create($this->apiContext);
        $this->approvalLink = $response->getApprovalLink();

        return $response;
    }

    /**
     * Redirect to PayPal
     *
     * @return \Illuminate\Http\Response
     */
    public function redirect()
    {
        return redirect($this->approvalLink);
    }

    /**
     * Executes, or completes, a PayPal payment that the payer has approved
     *
     * @param Request $request
     * @return Payment
     */
    public function executePayment(Request $request)
    {
        $payment = Payment::get($request->paymentId, $this->apiContext);

        $execution = new PaymentExecution();
        $execution->setPayerId($request->PayerID);

        return $payment->execute($execution, $this->apiContext);
    }
}
