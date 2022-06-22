<?php

namespace App\Traits\Orders;

use App\Models\OrderPricing;
use Illuminate\Support\Facades\Auth;
use App\Models\Configurations\Discipline;
use App\Models\Configurations\ClientConfiguration;

trait Calculator
{
    /**
     * Calculate the price of an order
     *
     * @param $request
     * @return float|int
     */
    public function calculate($request)
    {
        $pages = $request->pages;
        $technical = Discipline::find($request->discipline_id)->is_technical;

        $deadlineId = $request->deadline_id;
        $academicLevelId = $request->academic_level_id;

        if ($request->spacing === 'single') {
            $pages *= 2;
        }

        $amount = OrderPricing::getPrice('essay', $academicLevelId, $deadlineId) * $pages;

        // When the field is technical
        if ($technical) {
            $slides = $request->filled('ppt_slides') ? $request->ppt_slides: 0;

            $amount += OrderPricing::getPrice('technical-paper', $academicLevelId, $deadlineId) * ($pages + $slides);
        }

        // When the client selects a specific writer
        if ($request->filled('writer_id')) {
            $amount += OrderPricing::getPrice('preferred-writer', $academicLevelId, $deadlineId);
        }

        // When the client selects charts
        if ($request->filled('charts')) {
            $amount += OrderPricing::getPrice('chart', $academicLevelId, $deadlineId) * $request->charts;
        }

        // When the client selects PPT slides
        if ($request->filled('ppt_slides')) {
            $amount += OrderPricing::getPrice('presentation', $academicLevelId, $deadlineId) * $request->ppt_slides;
        }

        // When the client selects digital references
        if ($request->filled('requires_digital_references')) {
            $amount += OrderPricing::getPrice('digital-sources', $academicLevelId, $deadlineId);
        }

        if ($request->filled('plagiarism')) {
            $amount += OrderPricing::getPrice('plagiarism-report', $academicLevelId, $deadlineId);
        }

        if ($request->filled('grammar')) {
            $amount += OrderPricing::getPrice('grammar-report', $academicLevelId, $deadlineId);
        }

        // When the client selects enl writer
        if ($request->requires_enl_writer) {
            $slides = $request->filled('ppt_slides') ? $request->ppt_slides: 0;
            $amount += OrderPricing::getPrice('enl-writer', $academicLevelId, $deadlineId) *  ($pages + $slides);
        }

        return (double)$amount;
    }
}
