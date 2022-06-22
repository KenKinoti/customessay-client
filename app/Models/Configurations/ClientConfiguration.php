<?php

namespace App\Models\Configurations;

use Illuminate\Database\Eloquent\Model;

class ClientConfiguration extends Model
{
    /**
     * Attributes that can be mass assigned.
     *
     * @var array
     */
    protected $fillable = [
        'preferred_writer_price',
        'digital_references_price',
        'technical_discipline_price',
        'writer_deadline_percentage',
        'max_wallet_balance',
        'enl_writer_price'
    ];

    /**
     * The website that the config belongs to.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function website()
    {
        return $this->belongsTo(Website::class);
    }

    /**
     * Update configuration for the maximum wallets balance.
     *
     * @param int $balance
     * @return bool
     */
    public function updateBalance($balance)
    {
        $this->max_wallet_balance = $balance;

        return $this->save();
    }

    /**
     * Update the writer's deadline percentage.
     *
     * @param $deadline
     * @return bool
     */
    public function updateWriterDeadline($deadline)
    {
        $this->writer_deadline_percentage = $deadline;

        return $this->save();
    }
}
