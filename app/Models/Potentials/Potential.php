<?php

namespace App\Models\Potentials;

use Illuminate\Database\Eloquent\Model;

class Potential extends Model
{
    /**
     * Attributes that can be mass assigned.
     *
     * @var array
     */
    protected $fillable = ['email'];
}
