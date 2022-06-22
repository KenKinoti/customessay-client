<?php

namespace App\Traits;

use DateTime;
use Carbon\Carbon;

trait FormatsDates
{
    /**
     * Get a localized date format.
     *
     * @param $dateField
     * @param bool $localized
     * @return string
     */
    public function formattedDate($dateField, $localized = true)
    {
        if ($localized) {
            return $this->localize($dateField)->format(config('system.date_format'));
        }

        return $this->asDateTime($this->{$dateField})->format(config('system.date_format'));
    }

    /**
     * Localize a date to users timezone.
     *
     * @param null $dateField
     * @return Carbon
     */
    public function localize($dateField = null)
    {
        $dateValue = is_null($this->{$dateField}) ? Carbon::now() : $this->{$dateField};

        return $this->inUsersTimezone($dateValue);
    }

    /**
     * Change timezone of a carbon date
     *
     * @param $dateValue
     * @return Carbon
     */
    private function inUsersTimezone($dateValue): Carbon
    {
        $timezone = optional(auth()->user())->timezone ?? config('app.timezone');

        return $this->asDateTime($dateValue)->timezone($timezone);
    }

    /**
     * Get a localized time format.
     *
     * @param $dateField
     * @param bool $localized
     * @return string
     */
    public function formattedTime($dateField, $localized = true)
    {
        if ($localized) {
            return $this->localize($dateField)->format(config('system.date_format'));
        }

        return $this->asDateTime($this->{$dateField})->format(config('system.date_format'));
    }

    /**
     * Get a localized date time format.
     *
     * @param $dateField
     * @param bool $localized
     * @return string
     */
    public function formattedDateTime($dateField, $localized = true)
    {
        if ($localized) {
            return $this->localize($dateField)->format(config('system.date_time_format'));
        }

        return $this->asDateTime($this->{$dateField})->format(config('system.date_time_format'));
    }

    /**
     * Format the deadline
     *
     * @param $dateField
     * @return string
     */
    public function formatInterval($dateField)
    {
        $date = $this->asDateTime($this->{$dateField});
        $now = now();

        if ($now->diffInDays($date) > 30) {
            return $now->diffInDays($date, false).'d';
        }

        $interval = (new Carbon())->diff($date);

        if ($interval->d) {
            return $interval->format("%r%dd %hh");
        }
        if ($interval->h) {
            return $interval->format("%r%hh %im");
        }
        if ($interval->i) {
            return $interval->format("%r%im");
        }

        return $interval->format("%ss");
    }

}
