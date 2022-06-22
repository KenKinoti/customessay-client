<?php

namespace App\Rating;

use App\Common\OrderStatus;
use App\Models\Orders\Order;
use App\Models\Ratings\Rating;
use App\Models\User;
use App\Models\WriterProfile;

class Rater
{
    public static function create(Order $order, $value, $comments = '', $type = 'client_mark')
    {
        Rating::create([
            'user_id' => $order->writer_id,
            'order_id' => $order->id,
            'value' => $value,
            'comments' => $comments,
            'type' => $type,
        ]);
    }

    public static function update(Order $order)
    {
        $ratings = Rating::select('user_id')->where('order_id', $order->id)->distinct('user_id')->get();

        foreach ($ratings as $rating) {
            $totalOrders = self::getTotalOrders($rating->user);
            if($totalOrders  == 0){
                continue;
            }

            $overallRating = self::getRatings($rating->user);

            if ($overallRating > 0) {
                $profile = WriterProfile::where('user_id', $rating->user->id)->first();
                $profile->rating = $overallRating;
                $profile->save();
            }
        }
    }

    public static function getTotalOrders(User $user)
    {
        return Order::query()
            ->withoutGlobalScopes()
            ->where('writer_id', $user->id)
            ->where(function ($query) {
                $query->where('status', OrderStatus::ACCEPTED)
                    ->orWhere('status', OrderStatus::AUTO_ACCEPTED)
                    ->orWhere('status', OrderStatus::MANUALLY_ACCEPTED)
                    ->orWhere('status', OrderStatus::PARTIAL_REFUND)
                    ->orWhere('status', OrderStatus::REFUNDED);
            })
            ->count();
    }

    public static function getRatings(User $user)
    {
        $client = self::getClientRating($user);

        $editor = self::getEditorRating($user);

        return $client + $editor;
    }

    public static function getClientRating(User $user)
    {
        $totalRating = Rating::query()
            ->where(function ($query) {
                $query->where('type', 'client_mark')
                    ->orWhere('type', 'auto_client_mark');
            })
            ->whereHas('order', function ($query) {
                $query->where('status', OrderStatus::ACCEPTED)
                    ->orWhere('status', OrderStatus::AUTO_ACCEPTED)
                    ->orWhere('status', OrderStatus::MANUALLY_ACCEPTED)
                    ->orWhere('status', OrderStatus::PARTIAL_REFUND)
                    ->orWhere('status', OrderStatus::REFUNDED);
            })
            ->where('user_id', $user->id)
            ->sum('value');

        if ($totalOrders = self::getTotalOrders($user)) {
            return round($totalRating / $totalOrders, 2);
        }

        return 0.00;
    }

    public static function getEditorRating(User $user)
    {
        $totalRating = Rating::query()
            ->where(function ($query) {
                $query->where('type', '<>', 'client_mark')
                    ->where('type', '<>', 'auto_client_mark');
            })
            ->whereHas('order', function ($query) {
                $query->where('status', OrderStatus::ACCEPTED)
                    ->orWhere('status', OrderStatus::AUTO_ACCEPTED)
                    ->orWhere('status', OrderStatus::MANUALLY_ACCEPTED)
                    ->orWhere('status', OrderStatus::PARTIAL_REFUND)
                    ->orWhere('status', OrderStatus::REFUNDED);
            })
            ->where('user_id', $user->id)
            ->sum('value');

        if ($totalOrders = self::getTotalOrders($user)) {
            return round($totalRating / $totalOrders, 2);
        }

        return 0.00;
    }

    public static function doesNotHaveClientMarkFor(Order $order)
    {
        return !(Rating::query()
            ->where('order_id', $order->id)
            ->where('user_id', $order->writer_id)
            ->where(function ($query) {
                $query->where('type', 'client_mark')
                    ->orWhere('type', 'auto_client_mark');
            })->exists());
    }
}
