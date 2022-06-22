<?php

namespace App\Models\Configurations;

use Illuminate\Database\Eloquent\Model;

class Pricing extends Model
{
    /**
     * Attributes that can be mass assigned.
     *
     * @var array
     */
    protected $fillable = [
        'academic_level_id',
        'deadline_id',
        'website_id',
        'price',
        'type',
    ];

    /**
     * The table for the pricing.
     *
     * @var string
     */
    protected $table = 'order_pricing';

    /**
     * The deadline the pricing belongs to.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function deadline()
    {
        return $this->belongsTo(Deadline::class);
    }

    /**
     * The academic level the pricing belongs to.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function academicLevel()
    {
        return $this->belongsTo(AcademicLevel::class);
    }

    /**
     * Format the pricing collection to enable easy display on edit form.
     *
     * @param $websiteId
     * @return array
     */
    public static function formattedPricing($websiteId)
    {
        $pricing = self::select('academic_level_id', 'deadline_id', 'price','type')->whereWebsiteId($websiteId)->get();

        $formattedPricing = [];

        foreach ($pricing as $price) {
            $formattedPricing[$price['type'].'_l'.$price->academic_level_id.'-d'.$price->deadline_id] = $price->price;
        }

        return $formattedPricing;
    }
}
