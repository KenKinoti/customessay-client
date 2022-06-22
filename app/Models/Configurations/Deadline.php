<?php

namespace App\Models\Configurations;

use Illuminate\Database\Eloquent\Model;

class Deadline extends Model
{
    /**
     * Get deadlines that apply when creating an order.
     *
     * @param $query
     * @return mixed
     */
    public function scopeOrderDeadlines($query)
    {
        return $query->whereStage('CREATE')->get();
    }

    /**
     * Get deadlines that apply when sending order for review.
     *
     * @param $query
     * @return mixed
     */
    public function scopeOrderReviewDeadlines($query)
    {
        return $query->whereStage('REVIEW')->get();
    }
}
