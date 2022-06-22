<?php

namespace App\Models\Configurations;

use Illuminate\Database\Eloquent\Model;
use App\Models\Configurations\Api\PaypalApiConfiguration;

class Website extends Model
{
    public static function findByName($name)
    {
        return self::where('name', $name)->first();
    }

    public function writerConfigurations()
    {
        return $this->hasOne(WriterConfiguration::class)->withDefault();
    }

    public function clientConfigurations()
    {
        return $this->hasOne(ClientConfiguration::class)->withDefault();
    }

    public function payPalApiConfiguration()
    {
        return $this->hasOne(PaypalApiConfiguration::class)->withDefault();
    }

    public static function clients()
    {
        return self::whereType('Client')->get();

    }

    public static function writers()
    {
        return self::whereType('Writer')->get();

    }

    public static function clientsAndWriters()
    {
        return self::whereType('Writer')->orWhere('type', 'Client')->get();
    }
}
