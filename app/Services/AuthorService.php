<?php

namespace App\Services;

use App\DataTransferObjects\AuthorDTO;
use App\Models\Author;
use Illuminate\Database\Eloquent\Collection;

class AuthorService
{

    public function index(string|null $tag): Collection
    {
        $query = Author::query();

        // Apply filters
        if (isset($tag))
            $query->whereHas('tags', function ($q) use ($tag) {
                $q->where('text', $tag);
            });

        return  $query->with('tags')->get();
    }
    public function store(AuthorDTO $dto): Author
    {
        return Author::create((array)$dto);
    }
    public function show(int $id): Author
    {
        return Author::findOrFail($id);
    }
}
