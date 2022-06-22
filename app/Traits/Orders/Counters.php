<?php

namespace App\Traits\Orders;

use App\Common\OrderStatus;

trait Counters
{
    /**
     * Number of available orders for bidding.
     *
     * @return mixed
     */
    public static function pendingCount()
    {
        return self::where(function ($query) {
            $query->where('status', OrderStatus::AVAILABLE)
                ->orWhere('status', OrderStatus::PENDING_CONFIRMATION);
        })->count();
    }

    /**
     * Number of assigned orders.
     *
     * @return mixed
     */
    public static function assignedCount()
    {
        return self::where(function ($query) {
            $query->where('status', OrderStatus::ASSIGNED)
                ->orWhere('status', OrderStatus::SUBMITTED)
                ->orWhere('orders.status', OrderStatus::DEADLINE_EXTENSION_REQUESTED)
                ->orWhere('orders.status', OrderStatus::PENDING_ADMIN_REVIEW_CONFIRMATION)
                ->orWhere('orders.status', OrderStatus::ADMIN_REVISION_DEADLINE_EXTENSION_REQUESTED)
                ->orWhere('status', OrderStatus::REASSIGNMENT_REQUESTED)
                ->orWhere('status', OrderStatus::ADMIN_REVIEW_REASSIGNMENT_REQUESTED)
                ->orWhere('status', OrderStatus::REVIEW_BY_ADMIN);
        })->count();
    }

  /**
     * Number of assigned orders.
     *
     * @return mixed
     */
    public static function archievedCount()
    {
        return self::where(function ($query) {
       $query->whereStatus(OrderStatus::CANCELLED)
                    ->orWhere('status', OrderStatus::ACCEPTED)
                    ->orWhere('status', OrderStatus::AUTO_ACCEPTED)
                    ->orWhere('status', OrderStatus::PARTIAL_REFUND)
                    ->orWhere('status', OrderStatus::MANUALLY_ACCEPTED)
                    ->orWhere('status', OrderStatus::REFUNDED);
        })->count();
    }

    /**
     * Submitted orders count.
     *
     * @return mixed
     */
    public static function submittedCount()
    {
        return self::whereStatus(OrderStatus::FORWARDED)->count();
    }

    /**
     * Get number of orders under revision.
     *
     * @return mixed
     */
    public static function revisionsCount()
    {
        return self::where(function ($query) {
            $query->where('status', OrderStatus::PENDING_CLIENT_REVIEW_CONFIRMATION)
                ->orWhere('status', OrderStatus::CLIENT_REVIEW_SUBMISSION)
                ->orWhere('status', OrderStatus::REVISION_DEADLINE_EXTENSION_REQUESTED)
                ->orWhere('status', OrderStatus::REVIEW_BY_CLIENT);
        })->count();
    }

    /**
     * Number of orders under dispute
     *
     * @return mixed
     */
    public static function disputesCount()
    {
        return self::where(function ($query) {
            $query->whereStatus(OrderStatus::DISPUTED)
                ->orWhere('status', OrderStatus::PENDING_REFUND)
                ->orWhere('status', OrderStatus::REFUND_REVIEW);
        })->count();
    }
}
