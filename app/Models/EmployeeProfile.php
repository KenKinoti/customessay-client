<?php

namespace App\Models;

use App\Models\Configurations\Department;
use App\Models\Roles\Role;
use Illuminate\Database\Eloquent\Model;

class EmployeeProfile extends Model
{
    /**
     * The user attached to the profile.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * The department the user is in.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function department()
    {
        return $this->belongsTo(Department::class)->withDefault();
    }

    /**
     * A user has one role.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function role()
    {
        return $this->belongsTo(Role::class)->withDefault();
    }

    /**
     * Determine if the user has the given role.
     *
     * @param  string $role
     * @return boolean
     */
    public function hasRole($role)
    {
        return $this->role->name === $role;
    }

    /**
     * Determine if the user may perform the given permission.
     *
     * @param  string $permission
     * @return boolean
     */
    public function hasPermission($permission)
    {
        return $this->role->permissions->contains('name', $permission);
    }
}
