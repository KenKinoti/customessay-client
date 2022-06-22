<?php

namespace App\Models\Finance;

use App\Traits\FormatsDates;
use Illuminate\Database\Eloquent\Model;

class WalletTransaction extends Model
{
    use FormatsDates;

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
     * Attributes that aren't mass assignable.
     *
     * @var array
     */
    protected $guarded = [];

    /**
     * The wallet associated with the transaction.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function wallet()
    {
        return $this->belongsTo(Wallet::class);
    }
}
