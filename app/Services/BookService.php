<?php

namespace App\Services;

use App\DataTransferObjects\BookDTO;
use App\Models\Book;
use Illuminate\Support\Facades\Log;

class BookService
{
    public function store(BookDTO $dto): Book
    {
        return Book::create((array)$dto);
    }
}
