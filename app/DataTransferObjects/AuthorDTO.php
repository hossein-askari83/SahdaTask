<?php

namespace App\DataTransferObjects;

use Illuminate\Foundation\Http\FormRequest;

class AuthorDTO
{
    public function __construct(
        public readonly string|null $name,
    ) {
    }

    public static function fromRequest(FormRequest $request): AuthorDTO
    {
        return new self(
            $request->validated('name'),
        );
    }
}
