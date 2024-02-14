<?php

namespace App\DataTransferObjects;

use Illuminate\Foundation\Http\FormRequest;

class TagDTO
{
    public function __construct(
        public readonly string|null $text,
        public readonly string|null $taggable_type,
        public readonly string|null $taggable_id,
    ) {
    }

    public static function fromRequest(FormRequest $request): TagDTO
    {
        return new self(
            $request->validated('text'),
            $request->validated('taggable_type'),
            $request->validated('taggable_id'),
        );
    }
}
