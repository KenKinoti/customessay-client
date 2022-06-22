<?php

namespace App\Models\Ratings;

use App\Common\OrderStatus;
use App\Models\Orders\Order;
use App\Models\User;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

class Rating extends Model
{
    /**
     * Attributes that can't be mass assigned.
     *
     * @var array
     */
    protected $guarded = [];

    /**
     * The user associated with the rating.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * The order that is associated with the order.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function order()
    {
        return $this->belongsTo(Order::class);
    }

    public static function reviews($user = false)
    {
        $query = self::with('user', 'order.client')
            ->whereHas('order', function (Builder $query) {
                $query->whereHas('client', function (Builder $query) {
                    $query->where('website_id', websiteId());
                });
            })->whereHas('order', function (Builder $query) {
                $query->where('status', OrderStatus::ACCEPTED);
            });

        if ($user) {
            $query->where('user_id', $user);
        }

        return $query;
    }
}
