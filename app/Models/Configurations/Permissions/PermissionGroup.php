<?php

namespace App\Models\Configurations\Permissions;

use Illuminate\Database\Eloquent\Model;

class PermissionGroup extends Model
{
    /**
     * All permissions in the group.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function permissions()
    {
        return $this->hasMany(Permission::class);
    }
}
