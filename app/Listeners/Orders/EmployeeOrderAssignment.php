<?php

namespace App\Listeners\Orders;

use App\Events\Orders\OrderPlaced;
use App\Models\Orders\Order;
use App\Models\User;
use App\Notifications\Remote\NotifyEmployee;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Support\Arr;

class EmployeeOrderAssignment implements ShouldQueue
{
    /**
     * Handle the event.
     *
     * @param OrderCompleted $event
     * @return void
     */
    public function handle(OrderPlaced $event)
    {
        if (!is_null($event->order->employee_id)) {
            return;
        }

        if ($employee = $this->getEmployee($event->order)) {
            $event->order->employee_id = $employee->id;
            $event->order->employee_amount = $this->getEmployeePrice($event->order);
            $event->order->save();

            (new NotifyEmployee($employee->website))->orderAssigned($event->order);
        }
    }

    /**
     * Get the employee to be assigned to the order.
     *
     * @param $order
     * @return User|boolean
     */
    protected function getEmployee($order)
    {
        $permission = 'Handle Non-technical Orders';

        if ($order->discipline->is_technical) {
            $permission = 'Handle Technical Orders';
        }

        $users = User::withPermission($permission)->with('pendingEmployeeOrders')->get();

        if (!$users->count()) {
            return false;
        }

        $result = [];
        foreach ($users as $user) {
            $result[$user->id] = $user->pendingEmployeeOrders->count();
        }

        $sorted = Arr::sort($result);
        $userId = current(array_keys($sorted));


        return $users->where('id', $userId)->first();
    }

    /**
     * Get the  set employee price for the order.
     *
     * @param Order $order
     * @return float|int
     */
    protected function getEmployeePrice(Order $order)
    {
        $role = $order->employee->employeeProfile->role;

        if ($role->payment == 'PERCENTAGE') {
            return round($order->amount * $role->value / 100, 2);
        }

        $amount = $order->ppt_slides * $role->value;

        if ($order->spacing == 'single') {
            return round($amount + $order->pages * 2 * $role->value, 2);
        }

        return round($amount + $order->pages * $role->value, 2);
    }
}
