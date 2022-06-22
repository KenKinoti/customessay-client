<?php

namespace App\Models\Configurations;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;

class Department extends Model
{
    /**
     * Users in the department.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function users()
    {
        return $this->hasMany(User::class);
    }

    /**
     * Find departments that can receive user messages.
     *
     * @param $query
     * @return mixed
     */
    public function scopeCanReceiveMessages($query)
    {
        return $query->whereReceiveEnquiries(true);
    }
}
