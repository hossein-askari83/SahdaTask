<?php

namespace Database\Factories;

use App\Enums\TaggablesEnum;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Tag>
 */
class TagFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $taggable_type = fake()->randomElement(TaggablesEnum::values());
        $taggable = $taggable_type::factory()->create();
        return [
            'text' => fake()->word(),
            'taggable_type' => $taggable_type,
            'taggable_id' => $taggable->id,
        ];
    }
}
