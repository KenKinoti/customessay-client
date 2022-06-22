<?php

namespace App\Models\Orders;

use App\Models\User;
use App\Common\OrderStatus;
use App\Traits\FormatsDates;
use App\Common\MessageStates;
use App\Traits\Orders\Counters;
use App\Models\Messages\Message;
use App\Models\Finance\Transaction;
use Illuminate\Support\Facades\Auth;
use Spatie\MediaLibrary\Models\Media;
use Illuminate\Database\Eloquent\Model;
use App\Models\Configurations\Citation;
use App\Models\Configurations\Deadline;
use App\Models\Configurations\PaperType;
use App\Models\Configurations\Discipline;
use Illuminate\Database\Eloquent\Builder;
use Spatie\MediaLibrary\HasMedia\HasMedia;
use App\Models\Configurations\AcademicLevel;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\MediaLibrary\HasMedia\HasMediaTrait;

class Order extends Model implements HasMedia
{
    use SoftDeletes, Counters, HasMediaTrait, FormatsDates;

    /**
     * Attributes that should not be mass assigned.
     *
     * @var array
     */
    protected $guarded = [];

    /**
     * Attributes that should be cast to new types.
     *
     * @var array
     */
    protected $casts = [
        'related_orders' => 'array',
    ];

    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = [
        'accepted_at',
        'deadline_date',
    ];

    /**
     * Boot the model with some defaults.
     */
    public static function boot()
    {
        parent::boot();

        static::creating(function ($order) {
            $order->website_id = websiteId();
        });

        if (Auth::check()) {
            self::addGlobalScope('client', function (Builder $builder) {
                $builder->where('client_id', Auth::user()->id);
            });
        }
    }

    /**
     * Transactions associated with the order.
     *
     * @return \Illuminate\Database\Eloquent\Relations\MorphMany
     */
    public function transactions()
    {
        return $this->morphMany(Transaction::class, 'attachable');
    }

    /**
     * Set the deadline for delivering the order.
     *
     * @param $deadline
     * @return bool
     */
    public function setDeadlineDate($deadline)
    {
        $this->deadline_date = $deadline;

        return $this->save();
    }

    /**
     * Set the deadline before which the writer will deliver.
     *
     * @param $deadline
     * @return bool
     */
    public function setWriterDeadline($deadline)
    {
        $this->writer_deadline = $deadline;

        return $this->save();
    }

    /**
     * The order academic level.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function academicLevel()
    {
        return $this->belongsTo(AcademicLevel::class)->withDefault();
    }

    /**
     * The citation for the order.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function citation()
    {
        return $this->belongsTo(Citation::class)->withDefault();
    }

    /**
     * The paper type the order belongs to.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function paperType()
    {
        return $this->belongsTo(PaperType::class)->withDefault();
    }

    /**
     * The discipline for the order.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function discipline()
    {
        return $this->belongsTo(Discipline::class)->withDefault();
    }

    /**
     * The deadline for the order.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function deadline()
    {
        return $this->belongsTo(Deadline::class)->withDefault();
    }

    /**
     * The client who created the order.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function client()
    {
        return $this->belongsTo(User::class, 'client_id')->withDefault();
    }

    /**
     * The writer assigned to the order.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function writer()
    {
        return $this->belongsTo(User::class, 'writer_id')->withDefault();
    }

    /**
     * The employee assigned to the order.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function employee()
    {
        return $this->belongsTo(User::class, 'employee_id')->withDefault();
    }

    /**
     * Mark the order as paid.
     *
     * @return bool
     */
    public function paid()
    {
        $this->paid = true;
        $this->status = OrderStatus::AVAILABLE;

        if ($this->writer_id) {
            $this->status = OrderStatus::PENDING_CONFIRMATION;
        }

        return $this->save();
    }

    /**
     * Assign a writer chosen by the client.
     *
     * @param $writerId
     * @return bool
     */
    public function assignWriter($writerId)
    {
        $this->writer_id = $writerId;
        $this->is_direct_assignment = true;

        return $this->save();
    }

    /**
     * Cache the media on the object.
     *
     * @param string $collectionName
     *
     * @return mixed
     */
    public function loadMedia(string $collectionName)
    {
        $collection = $this->exists ? $this->media : collect($this->unAttachedMediaLibraryItems)->pluck('media');

        return $collection->filter(function (Media $mediaItem) use ($collectionName) {
            if ($collectionName == '') {
                return true;
            }

            return $mediaItem->collection_name === $collectionName;
        })->sortBy('order_column', null, true)->values();
    }

    /**
     * Get user specific messages.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function userMessages()
    {
        return $this->messages()->whereHas('states', function ($query) {
            $query->whereUserId(Auth::user()->id)->where(function ($query) {
                $query->where('state', MessageStates::UNREAD)->orWhere('state', MessageStates::READ)
                      ->orWhere('state', MessageStates::OWN);
            });
        })->orderBy('created_at', 'DESC');
    }

    /**
     * Get all the messages for the order.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function messages()
    {
        return $this->hasMany(Message::class);
    }

    /**
     * Get the comments concerning disputes.
     *
     * @return mixed
     */
    public function disputes()
    {
        return $this->comments()->whereType('DISPUTE');
    }

    /**
     * Order revision or dispute comments.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function comments()
    {
        return $this->hasMany(OrderComment::class);
    }

    /**
     * Get the comments concerning revisions.
     *
     * @return mixed
     */
    public function revisions()
    {
        return $this->comments()->whereType('REVISION');
    }

    /**
     * Get the refund details for the order.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function refund()
    {
        return $this->hasOne(Refund::class);
    }

    /**
     * Activity logs related to the order.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function activityLogs()
    {
        return $this->hasMany(OrderActivityLog::class);
    }

    /**
     * Get the file count for the order relevant to the user.
     *
     * @return bool|int
     */
    public function fileCount()
    {
        if (! $this->hasMedia('orders')) {
            return false;
        }

        $counter = 0;

        foreach ($this->getMedia('orders') as $media) {
            if ($media->getCustomProperty('target') == "Client" || $media->getCustomProperty('uploader') == "Client") {
                $counter++;
            }
        }

        return $counter;
    }

    /**
     * Eligible payments associated with the order.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function eligiblePayments()
    {
        return $this->hasMany(EligiblePayment::class)->where('status', '<>', EligiblePayment::INVALIDATED);
    }
}
