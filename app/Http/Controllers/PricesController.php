<?php

namespace App\Http\Controllers;

use App\Models\Configurations\Deadline;
use App\Models\Configurations\Pricing;
use App\Models\Configurations\Website;
use App\Models\Configurations\AcademicLevel;

class PricesController extends Controller
{
    /**
     * Show the pricing page.
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        return view('pages.pricing', [
            'client' => Website::findOrFail(websiteId()),
            'academicLevels' => AcademicLevel::all(),
            'deadlines' => Deadline::orderDeadlines(),
            'pricing' => Pricing::formattedPricing(websiteId()),
        ]);
    }
}
