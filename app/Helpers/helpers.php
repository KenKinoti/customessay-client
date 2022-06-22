<?php

use Illuminate\Support\Str;
use App\Models\Configurations\UserType;
use App\Models\Configurations\Website;

/**
 * Get the currency used in the application
 *
 * @return mixed
 */
function currency()
{
    return env('APP_CURRENCY');
}

/**
 * Get the first name of a user.
 *
 * @param $name
 * @return string
 */
function first_name($name)
{
    $first_space = strpos($name, ' ');
    $first_name = substr($name, 0, $first_space);

    return Str::limit($first_name, 10, '');
}

/**
 * Get current website ID
 *
 * @return string
 */
function websiteId()
{
    $website = Website::whereName(config('app.name'))->first();
    if (is_null($website)) {
        return '';
    }
    return $website->id;
}

/**
 * Get the current user type
 *
 * @return string
 */
function userTypeId()
{
    $userType = UserType::whereName(config('system.user_type'))->first();
    if (is_null($userType)) {
        return '';
    }
    return $userType->id;
}

/**
 * Get the id for the writer user type
 *
 * @return string
 */
function writerUserTypeId()
{
    $userType = UserType::whereName('Writer')->first();
    if (is_null($userType)) {
        return '';
    }
    return $userType->id;
}

/**
 * Get the id for the super administrator user type
 *
 * @return string
 */
function adminUserTypeId()
{
    $userType = UserType::whereName('Administrator')->first();
    if (is_null($userType)) {
        return '';
    }
    return $userType->id;
}