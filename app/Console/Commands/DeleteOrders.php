<?php

namespace App\Console\Commands;

use App\Common\OrderStatus;
use Carbon\Carbon;
use App\Models\Orders\Order;
use Illuminate\Console\Command;

class DeleteOrders extends Command
{

    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'orders:delete';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Clear 14 day old unpaid orders';

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
        $unpaidDate = Carbon::now()->subDays(14)->format('Y-m-d');

        $orders = Order::where('status', OrderStatus::UNPAID)
            ->whereDate('created_at', '<', $unpaidDate)
            ->get();

        $count = 0;

        foreach ($orders as $order) {
            $order->delete();
            $count++;
        }

        $this->info($count .' unpaid orders we deleted');
    }

}
