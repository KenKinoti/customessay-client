<?php

namespace App\Models\Orders;

use Illuminate\Database\Eloquent\Model;

class Refund extends Model
{
    /**
     * Refund pending completion.
     */
    const PENDING = 0;

    /**
     * A complete refund.
     */
    const PROCESSED = 1;

    /**
     * The order associated with the refund.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function order()
    {
        return $this->belongsTo(Order::class);
    }
}
