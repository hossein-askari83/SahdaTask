<?php

namespace App\DataTransferObjects;

use Illuminate\Foundation\Http\FormRequest;

class BookDTO
{
    public function __construct(
        public readonly string|null $title,
        public readonly int|null $author_id,
        public readonly int|null $price,
    ) {
    }

    public static function fromRequest(FormRequest $request): BookDTO
    {
        return new self(
            $request->validated('title'),
            $request->validated('author_id'),
            $request->validated('price'),
        );
    }
}
