<?php

namespace App\Http\Controllers;

use Alert;
use App\DataTables\Transactions\WalletTransactionsDataTable as Transactions;
use App\Models\Configurations\ClientConfiguration;
use App\Models\Configurations\PaymentMethod;
use App\Models\Finance\Transaction;
use App\Models\Finance\Wallet;
use App\Payments\PaymentGateway;
use Auth;
use Carbon\Carbon;
use Illuminate\Http\Request;

class WalletController extends Controller
{
    /**
     * WalletController constructor.
     */
    public function __construct()
    {
        $this->middleware('auth', ['except' => 'checkWallet']);
    }

    /**
     * View the wallet details.
     *
     * @param  Transactions $transactions
     * @return \Illuminate\Http\Response
     */
    public function index(Transactions $transactions)
    {
        return $transactions->render('app.wallet.index', [
            'balance' => Auth::user()->wallet->balance,
            'maxDeposit' => ClientConfiguration::first()->max_wallet_balance - Auth::user()->wallet->balance,
            'paymentMethods' => PaymentMethod::noWallet()->get(),
            'maxBalance' => ClientConfiguration::first()->max_wallet_balance,
        ]);
    }

    /**
     * Make a deposit to the wallet.
     *
     * @param Request $request
     * @return \Illuminate\Http\Response
     */
    public function deposit(Request $request)
    {
        $wallet = Wallet::myWallet();
        $max = ClientConfiguration::first()->max_wallet_balance - $wallet->balance;
        $this->validate($request, [
            'amount' => 'required|max:'.floor($max),
            'payment_method' => 'required',
        ]);

        if ($transaction = $this->createTransaction($wallet, (float) $request->amount, $request->payment_method)) {
            $gateWay = new PaymentGateway($request->payment_method);

            return $gateWay->makePayment($transaction, 'Wallet Deposit');
        }

        Alert::error('Error', 'We could not complete this transaction.');

        return redirect(route('wallet'));
    }

    /**
     * Generate a new transaction.
     *
     * @param \App\Models\Finance\Wallet $wallet
     * @param float $amount
     * @param string $paymentMethod
     * @return \App\Models\Finance\Transaction|bool
     */
    protected function createTransaction(Wallet $wallet, float $amount, string $paymentMethod)
    {
        $paymentMethod = PaymentMethod::whereCode($paymentMethod)->first();
        if (is_null($paymentMethod)) {
            return false;
        }

        return Transaction::create([
            'type' => 'd',
            'attachable_id' => $wallet->id,
            'attachable_type' => Wallet::class,
            'description' => 'Credit wallet at '.config('app.name'),
            'reference' => 'WAL'.Carbon::now()->timestamp,
            'payment_method_id' => $paymentMethod->id,
            'amount' => $amount,
        ]);
    }

    /**
     * Check if the user can make a wallet payment.
     *
     * @param Request $request
     * @return string
     */
    public function checkWallet(Request $request)
    {
        $this->validate($request, ['payment_method' => 'required', 'amount' => 'requiredIf:payment_method,wallet']);

        if ($request->get('payment_method') != 'wallet') {
            return 'true';
        }

        if (Auth::guest()) {
            return __('wallet.auth');
        }

        if ($request->amount > Auth::user()->wallet->balance) {
            return 'false';
        }

        return 'true';
    }
}
