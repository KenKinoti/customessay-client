<?php

namespace App\Console\Commands;

use App\Models\Ratings\Rating;
use App\Rating\Rater;
use Carbon\Carbon;
use App\Common\OrderStatus;
use App\Models\Orders\Order;
use Illuminate\Console\Command;
use App\Events\Orders\OrderAutoAccepted;

class AcceptOrders extends Command
{

    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'orders:accept';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Automatically accept orders two weeks after submission';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return void
     */
    public function handle()
    {
        $forwardedDate = Carbon::now()->subDays(14)->format('Y-m-d');

        $orders = Order::where('status', OrderStatus::FORWARDED)
            ->whereDate('updated_at', '<', $forwardedDate)
            ->get();

        $count = 0;

        foreach ($orders as $order) {
            $order->status = OrderStatus::AUTO_ACCEPTED;
            $order->accepted_at = today();
            $order->save();

            if (Rater::doesNotHaveClientMarkFor($order)) {
                Rater::create($order,5,null, 'auto_client_mark');
            }

            event(new OrderAutoAccepted($order));

            $count++;
        }

        $this->info($count . ' orders were auto accepted');
    }
}
