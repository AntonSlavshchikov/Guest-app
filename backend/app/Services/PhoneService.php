<?php

namespace App\Services;

use Io238\ISOCountries\Models\Country;
use Propaganistas\LaravelPhone\PhoneNumber;
use Propaganistas\LaravelPhone\Rules\Phone;

class PhoneService
{
    public static function getCountry(string $phone): string
    {
        $phone = new PhoneNumber($phone);
        $country = Country::find($phone->getCountry());
        return $country?->native_name;
    }
}
