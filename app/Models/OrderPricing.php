<?php

namespace App\Models;

use App\Models\Configurations\Deadline;
use App\Models\Configurations\AcademicLevel;

class OrderPricing extends BaseModel
{
    /**
     * The table for the pricing.
     *
     * @var string
     */
    protected $table = 'order_pricing';

    /**
     * Get the price for a specific type, academic level and deadline
     *
     * @param $type
     * @param $academicLevelId
     * @param $deadlineId
     * @return int
     */
    public static function getPrice($type, $academicLevelId, $deadlineId)
    {
        $priceDetails = self::where('type', $type)->where('academic_level_id', $academicLevelId)
                            ->where('deadline_id', $deadlineId)->first();

        if (is_null($priceDetails)) {
            return 0;
        }

        return $priceDetails->price;
    }

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
}
