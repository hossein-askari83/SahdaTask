<?php

namespace App\Enums;

use App\Models\Author;
use App\Models\Book;

enum TaggablesEnum: string
{
    case Book = "Book";
    case Author = "Author";

    public static function values(): array
    {
        return array_column(self::cases(), 'value');
    }
}
