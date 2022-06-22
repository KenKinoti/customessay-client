<?php

namespace App\Models\Configurations;

use Illuminate\Database\Eloquent\Model;

class WriterLevel extends Model
{
    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'value' => 'object',
    ];
}
