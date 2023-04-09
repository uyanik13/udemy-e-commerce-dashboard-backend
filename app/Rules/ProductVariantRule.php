<?php

namespace App\Rules;

use Closure;
use Illuminate\Contracts\Validation\ValidationRule;

class ProductVariantRule implements ValidationRule
{
    /**
     * Run the validation rule.
     *
     * @param  \Closure(string): \Illuminate\Translation\PotentiallyTranslatedString  $fail
     */
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        $decodedArray = json_decode($value, true);


        if(!is_array($decodedArray)){
            $fail("The {$attribute} must be a valid JSON array");
        }

        foreach ($decodedArray as $item)
        {   
            if (!is_array($item)) {
                $fail("The {$attribute} contains an invalid item.");
                return;
            }

            if (empty($item['id']) || !is_numeric($item['id'])) {
                $fail("The {$attribute} contains an item with an invalid 'id' property.");
                return;
            }

            if (empty($item['stock']) || !is_numeric($item['stock'])) {
                $fail("The {$attribute} contains an item with an invalid 'stock' property.");
                return;
            }

            if (empty($item['price']) || !is_numeric($item['price'])) {
                $fail("The {$attribute} contains an item with an invalid 'price' property.");
                return;
            }

            if (empty($item['value']) || !is_string($item['value'])) {
                $fail("The {$attribute} contains an item with an invalid 'value' property.");
                return;
            }
        }

    }
}
