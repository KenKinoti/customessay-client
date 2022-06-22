<?php

namespace App\Models\Blog;

use App\Models\Configurations\Website;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\MediaLibrary\HasMedia\HasMedia;
use Spatie\MediaLibrary\HasMedia\HasMediaTrait;

class Post extends Model implements HasMedia
{
    use HasMediaTrait, SoftDeletes;

    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = ['deleted_at'];

    /**
     * Get all the published blog posts.
     *
     * @return mixed
     */
    public static function posts()
    {
        return self::wherePublished(1)->whereHas('websites', function ($query) {
            $query->where('websites.id',websiteId());
        })->orderBy('created_at', 'DESC')->paginate(12);
    }

    /**
     * Websites that should display the post.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function websites()
    {
        return $this->belongsToMany(Website::class, 'post_websites');
    }

    /**
     * Search through the blog.
     *
     * @param $item
     * @return mixed
     */
    public static function search($item)
    {
        return self::where(function ($query) use ($item) {
            $query->where('title', 'LIKE', '%'.$item.'%')
                ->orWhere('content', 'LIKE', '%'.$item.'%');
        })->whereHas('websites', function ($query) {
            $query->where('websites.id',websiteId());
        })->orderBy('created_at', 'DESC');
    }

    /**
     * Get the category name for the blog.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function category()
    {
        return $this->belongsTo(Category::class)->withDefault();
    }
}
