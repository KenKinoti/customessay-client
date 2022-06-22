<?php

namespace App\Models\Messages;

use App\Models\User;
use App\Models\Orders\Order;
use App\Common\MessageStates;
use App\Traits\FormatsDates;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\HasMedia\HasMedia;
use Spatie\MediaLibrary\HasMedia\HasMediaTrait;

class Message extends Model implements HasMedia
{
    use HasMediaTrait, FormatsDates;

    /**
     * Attributes that can be mass assigned.
     *
     * @var array
     */
    protected $fillable = [
        'sender_id',
        'subject',
        'content',
        'recipient_id',
        'order_id',
        'flag',
    ];

    /**
     * A message has many states.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function states()
    {
        return $this->hasMany(MessageState::class);
    }

    /**
     * Sender of the message.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function sender()
    {
        return $this->belongsTo(User::class, 'sender_id');
    }

    /**
     * Receiver of the message.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function recipient()
    {
        return $this->belongsTo(User::class, 'recipient_id');
    }

    /**
     * The order the message is associated with.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function order()
    {
        return $this->belongsTo(Order::class)->withDefault();
    }

    /**
     * Get the user messages.
     *
     * @return mixed
     */
    public static function userMessages()
    {
        return self::whereHas('states', function ($query) {
            $query->whereUserId(Auth::user()->id)->where(function ($query) {
                $query->where('state', MessageStates::UNREAD)
                    ->orWhere('state', MessageStates::READ)
                    ->orWhere('state', MessageStates::OWN);
            });
        })->orderBy('created_at', 'DESC');
    }

    /**
     * Find the unread message state.
     *
     * @param $user
     * @return object|null
     */
    public function isUnread($user)
    {
        return $this->states()->where('user_id', $user->id)
            ->where('state', MessageStates::UNREAD)
            ->first();
    }
}
