<?php

namespace Database\Factories;

use App\Enums\TaggablesEnum;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\App;

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
        $taggable_type = App::make("App\\Models\\$taggable_type");
        return [
            'text' => fake()->word(),
            'taggable_type' => class_basename($taggable_type),
            'taggable_id' => $taggable_type::inRandomOrder()->first()->id,
        ];
    }
}
