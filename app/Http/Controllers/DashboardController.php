<?php

namespace App\Http\Controllers;

use App\Common\OrderStatus;
use App\Models\Orders\Order;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    /**
     * Initialize while ensuring user is authenticated
     *
     * DashboardController constructor.
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the client dashboard
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        return view('app.dashboard', [
            'walletBalance' => Auth::user()->wallet->balance,
            'latestOrders' => Order::latest()->limit(5)->get(),
            'notifications' => Auth::user()->notifications()->take(7)->get(),
            'status' => new OrderStatus(),
        ]);
    }
}
