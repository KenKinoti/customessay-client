<?php

namespace App\Traits\Orders;

use App\Common\OrderStatus;
use App\Models\Orders\Order;
use Illuminate\Database\Eloquent\Builder;

trait HasOrders
{
    /**
     * Get the all the orders by the client.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function orders()
    {
        return $this->hasMany(Order::class, 'client_id');
    }

    /**
     * All orders assigned to the employee.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function employeeOrders()
    {
        return $this->hasMany(Order::class, 'employee_id');
    }

    public function writerOrders()
    {
        return $this->hasMany(Order::class, 'writer_id')
            ->where(function (Builder $query) {
                $query->where('status', OrderStatus::ACCEPTED)
                    ->orWhere('status', OrderStatus::AUTO_ACCEPTED)
                    ->orWhere('status', OrderStatus::MANUALLY_ACCEPTED);
            });
    }

    /**
     * Get the employee pending orders.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function pendingEmployeeOrders()
    {
        return $this->employeeOrders()
            ->where('status', '<>', OrderStatus::SUBMITTED)
            ->where('status', '<>', OrderStatus::FORWARDED)
            ->where('status', '<>', OrderStatus::ACCEPTED)
            ->where('status', '<>', OrderStatus::AUTO_ACCEPTED)
            ->where('status', '<>', OrderStatus::MANUALLY_ACCEPTED)
            ->where('status', '<>', OrderStatus::CANCELLED)
            ->where('status', '<>', OrderStatus::DISPUTED)
            ->where('status', '<>', OrderStatus::PARTIAL_REFUND)
            ->where('status', '<>', OrderStatus::REFUNDED);
    }
}
