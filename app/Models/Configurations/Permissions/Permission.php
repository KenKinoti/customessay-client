<?php

namespace App\Models\Configurations\Permissions;

use Illuminate\Database\Eloquent\Model;

class Permission extends Model
{
    /**
     * The group the permission belongs.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function permissionGroup()
    {
        return $this->belongsTo(PermissionGroup::class);
    }
}
