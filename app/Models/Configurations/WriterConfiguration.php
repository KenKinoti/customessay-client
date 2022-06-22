<?php

namespace App\Models\Configurations;

use Illuminate\Database\Eloquent\Model;

class WriterConfiguration extends Model
{
    public function website()
    {
        return $this->belongsTo(Website::class);
    }
}
