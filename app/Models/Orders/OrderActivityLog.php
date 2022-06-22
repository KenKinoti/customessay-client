<?php

namespace App\Models\Orders;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class OrderActivityLog extends Model
{
    /**
     * The attributes that aren't mass assignable.
     *
     * @var array
     */
    protected $guarded = [];

    /**
     * Create a new order log.
     *
     * @param $order
     * @param $description
     * @return mixed
     */
    public static function record($order, $description)
    {
        return self::create([
            'order_id' => $order->id,
            'description' => $description,
            'user_id' => Auth::user()->id,
        ]);
    }

    /**
     * The user that created the log.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * The order related to the log.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function order()
    {
        return $this->belongsTo(Order::class);
    }
}
