<?php

namespace App\Models\Applications;

use Illuminate\Support\Facades\Auth;
use App\Models\Configurations\Citation;
use Illuminate\Database\Eloquent\Model;
use App\Models\Configurations\Discipline;

class Skill extends Model
{
    /**
     * Attributes that can be mass assigned.
     *
     * @var array
     */
    protected $fillable = [
        'past_writer', 'citations', 'disciplines'
    ];

    /**
     * Cast attributes to native types.
     *
     * @var array
     */
    protected $casts = [
        'citations' => 'array',
        'disciplines' => 'array'
    ];

    

    /**
     * The selected citations for the user.
     *
     * @return mixed
     */
    public function selectedCitations()
    {
        return Citation::find($this->citations);
    }

    /**
     * The selected disciplines for the user.
     *
     * @return mixed
     */
    public function selectedDisciplines()
    {
        return Discipline::find($this->disciplines);
    }
}
