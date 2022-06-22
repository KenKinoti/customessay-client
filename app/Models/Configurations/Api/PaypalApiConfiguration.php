<?php

namespace App\Models\Configurations\Api;

use App\Models\Configurations\Website;
use Illuminate\Database\Eloquent\Model;

class PaypalApiConfiguration extends Model
{
    /**
     * The website the configuration is associated with.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function website()
    {
        return $this->belongsTo(Website::class);
    }
}
