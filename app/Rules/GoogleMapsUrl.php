<?php

namespace App\Rules;

use Closure;
use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Translation\PotentiallyTranslatedString;

class GoogleMapsUrl implements ValidationRule
{
    /**
     * Run the validation rule.
     *
     * @param  Closure(string, ?string=): PotentiallyTranslatedString  $fail
     */
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        // Check for google.com/maps, maps.google.com, or the goo.gl/maps shortener
        $pattern = '/^((https?:\/\/)?(www\.|maps\.)?google\.[a-z]{2,3}(\/maps|\/place|\/search).*)|((https?:\/\/)?maps\.app\.goo\.gl\/[a-zA-Z0-9]+)$/i';
        if (!preg_match($pattern, $value)) {
            $fail('The :attribute must be a valid Google Maps link.');
        }
    }
}
