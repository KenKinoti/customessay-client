<?php

namespace App\Models;

use App\Models\Configurations\WriterLevel;
use Illuminate\Database\Eloquent\Model;

class WriterProfile extends Model
{
    /**
     * The writer level for the profile.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function writerLevel()
    {
        return $this->belongsTo(WriterLevel::class)->withDefault();
    }
}
