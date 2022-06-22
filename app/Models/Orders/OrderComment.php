<?php

namespace App\Models\Orders;

use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;

class OrderComment extends Model
{
    /**
     * Attributes that can't be mass assigned.
     *
     * @var array
     */
    protected $guarded = [];

    /**
     * Boot the model with some defaults.
     */
    public static function boot()
    {
        parent::boot();

        self::addGlobalScope('user', function (Builder $builder) {
            $builder->where('user_id', Auth::user()->id);
        });
    }
}
