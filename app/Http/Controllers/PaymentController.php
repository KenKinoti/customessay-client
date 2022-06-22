<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Orders\Order;
use App\Models\Tpayments\Tpayment;
use DataTables;
use Session;
use Yajra\DataTables\Services\DataTable;
class PaymentController extends Controller
{
  public function index (Request $request){

return Session::all();
  	$totalPayment=Order::where('status','7')->sum('amount');

 if ($request->ajax()) {
    $data=Tpayment::all();
            return DataTables::of($data)
                ->make(true);
        }
             

        return view('app.payments.index',["totalPayment"=>$totalPayment]);

  }
}
