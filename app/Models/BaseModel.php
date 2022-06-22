<?php

namespace App\Models;

use App\Scopes\WebsiteScope;
use Illuminate\Database\Eloquent\Model;

class BaseModel extends Model
{
    /**
     * Boot the model with the website scope.
     *
     * @return void
     */
    public static function boot()
    {
        parent::boot();

        self::addGlobalScope(new WebsiteScope);
    }
}
