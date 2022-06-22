<?php

namespace App\Models\Configurations;

use Illuminate\Database\Eloquent\Model;

class AcademicLevel extends Model
{
    /**
     * Get the deadlines for the academic levels
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function deadlines()
    {
        return $this->belongsToMany(Deadline::class, 'academic_level_deadline_pricing')
            ->withPivot('price');
    }

    /**
     * Academic levels that belong to the website
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function website()
    {
        return $this->belongsToMany(Website::class, 'academic_level_website')
            ->wherePivot('website_id', websiteId());
    }
}
