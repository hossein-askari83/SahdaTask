<?php

namespace App\Http\Resources;

use App\Models\Author;
use App\Models\Book;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class TagResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'text' => $this->text,
            'taggable_type' => $this->taggable_type,
            'taggable_id' => $this->taggable_id,
            'updated_at' => $this->updated_at,
            'created_at' => $this->created_at,
            'taggable' => $this->when($this->relationLoaded('taggable'), function () {
                if ($this->taggable instanceof Book)
                    return new  BookResource($this->taggable);
                elseif ($this->taggable instanceof Author)
                    return new  AuthorResource($this->taggable);
            })
        ];
    }
}
