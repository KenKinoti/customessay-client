<?php

namespace App\Models;

use App\Models\Applications\Application;
use App\Models\Applications\Skill;
use App\Models\Configurations\Country;
use App\Models\Finance\Wallet;
use App\Models\Notifications\Notification;
use App\Traits\Messages\HasMessages;
use App\Traits\Orders\HasOrders;
use App\Traits\User\HasRole;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Str;
use Spatie\MediaLibrary\HasMedia\HasMedia;
use Spatie\MediaLibrary\HasMedia\HasMediaTrait;

class User extends Authenticatable implements HasMedia
{
    use Notifiable, HasMediaTrait, HasMessages, HasRole, HasOrders, SoftDeletes;

    /**
     * Status for an deactivated account.
     */
    const DEACTIVATED = 0;

    /**
     * Status for an activated account.
     */
    const ACTIVATED = 1;

    /**
     * Status for a suspended account.
     */
    const SUSPENDED = 2;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'receive_emails',
        'phone_number',
        'country_code',
        'timezone',
    ];

    /**
     * Attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = ['deleted_at'];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Boot the model.
     *
     * @return void
     */
    public static function boot()
    {
        parent::boot();

        static::creating(function ($user) {
            $user->validation_code = Str::random(30);
            $user->website_id = websiteId();
            $user->user_type_id = userTypeId();
        });
    }

    /**
     * Get employees with a certain permission.
     *
     * @param string $permission
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public static function withPermission($permission, $department = false)
    {
        return self::whereHas('employeeProfile', function (Builder $query) use ($permission, $department) {
            if ($department) {
                $query->where('department_id', $department);
            }

            $query->whereHas('role', function (Builder $query) use ($permission) {
                $query->whereHas('permissions', function (Builder $query) use ($permission) {
                    $query->where('name', $permission);
                });
            });
        });
    }

    /**
     * Activate the user account.
     *
     * @return bool
     */
    public function acceptEmail()
    {
        $this->validation_code = null;

        return $this->save();
    }

    /**
     * The profile for the employee.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function employeeProfile()
    {
        return $this->hasOne(EmployeeProfile::class);
    }

    /**
     * The profile for the writer.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function writerProfile()
    {
        return $this->hasOne(WriterProfile::class);
    }

    /**
     * Writer applications.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function application()
    {
        return $this->hasOne(Application::class);
    }

    /**
     * Get the users wallet.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function wallet()
    {
        return $this->hasOne(Wallet::class);
    }

    /**
     * Get the entity's notifications.
     *
     * @return \Illuminate\Database\Eloquent\Relations\MorphMany
     */
    public function notifications()
    {
        return $this->morphMany(Notification::class, 'notifiable')->orderBy('created_at', 'desc');
    }

    /**
     * The country the user is from.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function country()
    {
        return $this->belongsTo(Country::class, 'country_code', 'code');
    }

    public function skill()
    {
        return $this->hasOne(Skill::class);
    }
}
