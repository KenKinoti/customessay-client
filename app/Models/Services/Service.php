<?php

namespace App\Models\Services;

use App\Models\Configurations\Website;
use App\Traits\FormatsDates;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\HasMedia\HasMedia;
use Spatie\MediaLibrary\HasMedia\HasMediaTrait;

class Service extends Model implements HasMedia
{
    use FormatsDates, HasMediaTrait;

    public function websites()
    {
        return $this->belongsToMany(Website::class, 'service_websites');
    }

    /**
     * Get all the published blog posts.
     *
     * @return mixed
     */
    public static function general()
    {
        return self::wherePublished(1)->whereHas('websites', function ($query) {
            $query->where('websites.id', websiteId());
        })->orderBy('created_at', 'DESC')->get();
    }

    /**
     * Get all the published blog posts.
     *
     * @param \Illuminate\Database\Eloquent\Builder $query
     * @param string $slug
     * @return mixed
     */
    public function scopeFindBySlug(Builder $query, string $slug)
    {
        return $query->where('published', 1)->whereHas('websites', function ($query) {
            $query->where('websites.id', websiteId());
        })->where(function ($query) use ($slug) {
            $query->where('slug', $slug);
        });
    }
}
