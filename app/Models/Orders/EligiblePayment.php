<?php

namespace App\Models\Orders;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;

class EligiblePayment extends Model
{
    /**
     * Eligible payments that have not been requested.
     */
    const PENDING = 0;

    /**
     * Eligible payments that have been requested.
     */
    const REQUESTED = 1;

    /**
     * Eligible payments that have been payed out.
     */
    const PROCESSED = 2;

    /**
     * Eligible payments that are invalid.
     */
    const INVALIDATED = 3;

    /**
     * Attributes that can't be mass assigned.
     *
     * @var array
     */
    protected $guarded = [];

    /**
     * The user associated with the eligible order.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * The order details associated with the record.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function order()
    {
        return $this->belongsTo(Order::class);
    }
}
