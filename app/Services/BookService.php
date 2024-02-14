<?php

namespace App\Services;

use App\DataTransferObjects\BookDTO;
use App\Models\Book;
use Illuminate\Database\Eloquent\Collection;

class BookService
{

    public function index(string|null $tag): Collection
    {
        $query = Book::query();

        // Apply filters
        if (isset($tag))
            $query->whereHas('tags', function ($q) use ($tag) {
                $q->where('text', $tag);
            });

        return  $query->with('author', 'tags')->get();
    }
    public function store(BookDTO $dto): Book
    {
        return Book::create((array)$dto);
    }
    public function show(int $id): Book
    {
        return Book::findOrFail($id);
    }
    public function update(BookDTO $dto, int $id): Book
    {
        $book = Book::findOrFail($id);
        return tap($book)->update(array_filter((array)$dto));
    }
}
