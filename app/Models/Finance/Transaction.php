<?php

namespace App\Models\Finance;

use App\Common\TransactionStatus;
use App\Models\Configurations\PaymentMethod;
use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Transaction extends Model
{
    /**
     * Status for a pending transaction
     */
    const PENDING = 0;

    /**
     * Status for a complete transaction
     */
    const COMPLETE = 1;

    /**
     * Status for a failed transaction
     */
    const FAILED = 2;


    /**
     * Status for a cancelled transaction
     */
    const CANCELLED = 3;

    /**
     * Attributes that can't be mass assigned.
     *
     * @var array
     */
    protected $guarded = [];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'gateway_details' => 'object',
    ];

    /**
     * Boot the model with some defaults.
     *
     * @return void
     */
    public static function boot()
    {
        parent::boot();

        static::creating(function ($transaction) {
            $transaction->user_id = Auth::user()->id;
            $transaction->initiator_id = Auth::check() ? Auth::user()->id : "SYSTEM";
            $transaction->website_id = websiteId();
        });
    }

    /**
     * Attach different models to a transaction.
     *
     * @return \Illuminate\Database\Eloquent\Relations\MorphTo
     */
    public function attachable()
    {
        return $this->morphTo();
    }

    /**
     * Mark a transaction as pending.
     *
     * @return bool
     */
    public function pending()
    {
        $this->status = TransactionStatus::PENDING;

        return $this->save();
    }

    /**
     * Complete a transaction.
     *
     * @return bool
     */
    public function complete()
    {
        $this->status = TransactionStatus::COMPLETE;

        return $this->save();
    }

    /**
     * Mark a transaction as failed.
     *
     * @return bool
     */
    public function failed()
    {
        $this->status = TransactionStatus::FAILED;

        return $this->save();
    }

    /**
     * Cancel a transaction.
     *
     * @return bool
     */
    public function cancelled()
    {
        $this->status = TransactionStatus::CANCELLED;

        return $this->save();
    }

    /**
     * The transaction's payment method.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function paymentMethod()
    {
        return $this->belongsTo(PaymentMethod::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
