<?php

namespace App\Rules\Tag;

use Closure;
use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Support\Facades\App;

class TaggableIDRule implements ValidationRule
{

    public function __construct(public $taggable_type)
    {
    }
    /**
     * Run the validation rule.
     *
     * @param  \Closure(string): \Illuminate\Translation\PotentiallyTranslatedString  $fail
     */
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        if (isset($this->taggable_type)) {
            $taggable = App::make("App\\Models\\$this->taggable_type");
            $taggable::findorFail($value);
        }
    }
}
