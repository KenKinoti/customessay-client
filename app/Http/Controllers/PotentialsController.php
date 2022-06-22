<?php

namespace App\Http\Controllers;

use App\Models\Configurations\Deadline;
use Illuminate\Http\Request;
use App\Models\Potentials\Potential;

class PotentialsController extends Controller
{
    /**
     * Redirect to order page.
     *
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function index(Request $request)
    {
        if($request->filled('email') && !Potential::whereEmail($request->email)->exists()){
            Potential::create([
                'email' => $request->email
            ]);
        }

        return redirect(route('orders.create'))->withInput([
            'email' => $request->email ?? '',
            'coupon_code' => $request->coupon ?? '',
            'deadline_id' => $this->getDeadlineFromRequest($request),
            'paper_type_id' => $request->paper,
            'pages' => $request->pages ?? 1,
            'writer_id' => $request->writer ?? '',
            'academic_level_id' => $request->academicLevel ?? 2,
            'instructions' => $request->instructions ?? '',
            'topic' => $request->topic ?? '',
            'slides' => $request->slides ?? 0,
            'charts' => $request->charts ?? 0
        ]);
    }

    private function getDeadlineFromRequest(Request $request)
    {
        if($request->filled('deadline')){
            return Deadline::find($request->deadline)->id;
        }

        return Deadline::whereName('14 Days')->first()->id;
    }
}
