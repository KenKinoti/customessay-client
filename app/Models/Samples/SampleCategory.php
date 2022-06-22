<?php

namespace App\Models\Samples;

use App\Traits\FormatsDates;
use Illuminate\Database\Eloquent\Model;

class SampleCategory extends Model
{
    use FormatsDates;

    protected $table = 'samplecategories';

    /**
     * Attributes that can be mass assigned.
     *
     * @var array
     */
    protected $fillable = ['name'];

    /**
     * Posts in the category.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function samples()
    {
        return $this->hasMany(Sample::class, 'samplecategory_id');
    }
}
