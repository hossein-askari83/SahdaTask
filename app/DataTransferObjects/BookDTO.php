<?php

namespace App\DataTransferObjects;

use App\Http\Requests\Book\StoreBookRequest;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Request;

class BookDTO
{
    public function __construct(
        public readonly string $title,
        public readonly int $author_id,
        public readonly int $price,
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
