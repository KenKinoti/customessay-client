<?php

namespace App\Traits\User;

use App\Common\ApplicationStatus;
use App\Models\Roles\Role;
use App\Models\Configurations\Website;
use App\Models\Configurations\UserType;
use App\Models\Configurations\Department;
use Illuminate\Database\Eloquent\Builder;

trait HasRole
{
    /**
     * The website the user belongs to.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function website()
    {
        return $this->belongsTo(Website::class)->withDefault();
    }

    /**
     * The user type for the user.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function userType()
    {
        return $this->belongsTo(UserType::class)->withDefault();
    }

    /**
     * Check if user is administrator
     *
     * @return boolean
     */
    public function isAdministrator()
    {
        return $this->userType->name == "Administrator";
    }

    /**
     * Get all the system administrators.
     *
     * @return mixed
     */
    public static function administrators()
    {
        return self::whereHas('userType', function (Builder $query) {
            $query->where('name', 'Administrator');
        })->whereStatus(self::ACTIVATED);
    }

    /**
     * Get all the active writers.
     *
     * @param Builder $query
     * @return mixed
     */
    public function scopeWriters(Builder $query)
    {
        return $query->whereHas('application', function ($query) {
            $query->where('status', ApplicationStatus::APPROVED);
        })->where('status', self::ACTIVATED);
    }
}
