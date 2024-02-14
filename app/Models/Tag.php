<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{
    use HasFactory;

    protected $fillable = [
        'text',
        'taggable_type',
        'taggable_id',
    ];

    public function taggable()
    {
        return $this->morphTo('taggable');
    }
}
