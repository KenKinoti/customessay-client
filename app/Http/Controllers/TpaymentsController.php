<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;

use App\Models\Orders\Order;

use App\Models\Tpayments\Tpayment;

class TpaymentsController extends Controller
{
    //
    function Payment(Request $request){
    	Tpayment::create($request->all());
order::where("status","7")->update(Array("status"=>"27"));
    	 Alert::success('Success','Amount Paid successfully')->persistent();
    	return back();
    }

}
