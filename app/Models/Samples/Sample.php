<?php

namespace App\Models\Samples;

use App\Models\Configurations\Website;
use App\Models\Configurations\Discipline;
use App\Models\Configurations\PaperType;
use App\Models\Configurations\AcademicLevel;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\MediaLibrary\HasMedia\HasMedia;
use Spatie\MediaLibrary\HasMedia\HasMediaTrait;

class Sample extends Model implements HasMedia
{
    use HasMediaTrait, SoftDeletes;

    public static function boot()
    {
        parent::boot();

        self::addGlobalScope('websites', function (Builder $builder) {
            $builder->whereHas('websites', function (Builder $query) {
                $query->where('websites.id', websiteId());
            })->where('published', 1);
        });
    }

    public function scopePublished(Builder $query)
    {
        return $query->orderBy('created_at', 'DESC')->paginate(10);
    }

    public function scopeFromCategory(Builder $query, $set)
    {
        return $query->whereHas('category', function (Builder $query) use ($set) {
            $query->where('name', $set);
        })->orderBy('created_at', 'DESC')->paginate(10);
    }

    public function scopeSearch(Builder $query, $phrase)
    {
        return $query->where(function (Builder $query) use ($phrase) {
            $query->whereHas('category', function (Builder $query) use ($phrase) {
                $query->where('name', 'like', '%' . $phrase . '%');
            })->orWhereHas('discipline', function (Builder $query) use ($phrase) {
                $query->where('name', 'like', '%' . $phrase . '%');
            })->orWhereHas('academicLevel', function (Builder $query) use ($phrase) {
                $query->where('name', 'like', '%' . $phrase . '%');
            })->orWhereHas('paperType', function (Builder $query) use ($phrase) {
                $query->where('name', 'like', '%' . $phrase . '%');
            })->orWhere('title', 'like', '%' . $phrase . '%');
        })->orderBy('created_at', 'DESC')->paginate(10);
    }

    public function websites()
    {
        return $this->belongsToMany(Website::class, 'sample_websites');
    }

    public function category()
    {
        return $this->belongsTo(SampleCategory::class, 'samplecategory_id')->withDefault();
    }

    public function academicLevel()
    {
        return $this->belongsTo(AcademicLevel::class, 'education')->withDefault();
    }

    public function discipline()
    {
        return $this->belongsTo(Discipline::class, 'discpline')->withDefault();
    }

    public function paperType()
    {
        return $this->belongsTo(PaperType::class, 'paper')->withDefault();
    }

}
