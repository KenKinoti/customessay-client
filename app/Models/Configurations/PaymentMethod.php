<?php

namespace App\Models\Configurations;

use Illuminate\Database\Eloquent\Model;

class PaymentMethod extends Model
{
    /**
     * Payment methods without wallet.
     *
     * @param $query
     * @return mixed
     */
    public static function scopeNoWallet($query)
    {
        return $query->where('code','paypal');
    }
}
