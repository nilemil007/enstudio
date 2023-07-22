<?php

namespace App\Rules;

use Closure;
use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Translation\PotentiallyTranslatedString;

class Nid implements ValidationRule
{
    /**
     * Run the validation rule.
     *
     * @param string $attribute
     * @param mixed $value
     * @param \Closure(string): PotentiallyTranslatedString $fail
     */
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        if ( strlen( $value ) === 10 || strlen( $value ) === 13 || strlen( $value ) === 17){

        }else{
            $fail('The :attribute should be 10/13/17 digit number only.');
        }
    }
}
