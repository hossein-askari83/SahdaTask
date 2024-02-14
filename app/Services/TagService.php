<?php

namespace App\Services;

use App\DataTransferObjects\TagDTO;
use App\Models\Tag;
use Illuminate\Database\Eloquent\Collection;

class TagService
{

    public function index(): Collection
    {
        return  Tag::with('taggable')->get();
    }
    public function store(TagDTO $dto): Tag
    {
        return Tag::create((array)$dto);
    }
    public function show(int $id): Tag
    {
        return Tag::findOrFail($id);
    }
}
