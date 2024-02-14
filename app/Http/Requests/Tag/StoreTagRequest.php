<?php

namespace App\Http\Requests\Tag;

use App\Enums\TaggablesEnum;
use App\Rules\Tag\TaggableIDRule;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreTagRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'text' => ['required', 'string', 'max:191'],
            'taggable_type' => ['required', Rule::in(TaggablesEnum::values())],
            'taggable_id' => ['required', new TaggableIDRule($this->get('taggable_type'))]
        ];
    }
}
