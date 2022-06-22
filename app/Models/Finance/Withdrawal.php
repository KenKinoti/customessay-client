<?php

namespace App\Models\Finance;

use App\Models\Configurations\PaymentMethod;
use App\Models\User;
use Illuminate\Database\Eloquent\Model;

class Withdrawal extends Model
{
    /**
     * Withdrawal is pending approval.
     */
    const PENDING = 0;

    /**
     * Withdrawal has been approved and paid.
     */
    const APPROVED = 1;

    /**
     * Withdrawal has been declined.
     */
    const DECLINE = 2;

    /**
     * Attributes that can be mass assigned.
     *
     * @var array
     */
    protected $fillable = [
        'user_id',
        'amount',
        'status',
        'processed_at',
        'payment_method',
        'payment_method_details',
        'payment_items',
    ];

    /**
     * The user associated with the payment request.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Payment method associated with the withdrawal.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function paymentMethod()
    {
        return $this->belongsTo(PaymentMethod::class);
    }
}
