<?php

namespace App\Http\Controllers;

use App\Common\OrderStatus;
use App\Http\Requests\StoreOrder;
use App\Models\Configurations\AcademicLevel;
use App\Models\Configurations\Citation;
use App\Models\Configurations\Deadline;
use App\Models\Configurations\Discipline;
use App\Models\Configurations\PaperType;
use App\Models\OrderPricing;
use App\Models\Orders\OrderActivityLog;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class OrderEnquiryController extends Controller
{
    public function create()
    {
        return view('orders.enquiry',[
            'paperTypes' => PaperType::all(['id', 'name']),
            'disciplines' => Discipline::all(['id', 'name', 'is_technical']),
            'citations' => Citation::all(['id', 'name']),
            'academicLevels' => AcademicLevel::all(),
            'deadlines' => Deadline::orderDeadlines(),
            'relatedOrders' => Auth::check() ? Auth::user()->orders : [],
            'pricing' => $this->getPrices(),
            'spacing' => ['double', 'single'],
            'status' => new OrderStatus(),
        ]);
    }

    protected function getPrices()
    {
        return collect([
            'prices' => OrderPricing::all(),
        ]);
    }
}
