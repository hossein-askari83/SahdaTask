<?php

namespace Tests\Unit;

use App\Enums\TaggablesEnum;
use App\Models\Tag;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\App;
use Symfony\Component\HttpFoundation\Response;
use Tests\TestCase;

class TagControllerTest extends TestCase
{
    use RefreshDatabase;

    //Store Tag Tests
    public function test_store_tag_successfully(): void
    {
        $taggable_type = fake()->randomElement(TaggablesEnum::values());
        $taggable = App::make("App\\Models\\$taggable_type");
        $taggable_id = $taggable::factory()->create()->id;
        $response = $this->postJson(route('tag.store'), [
            'text' => fake()->word(),
            'taggable_type' => $taggable_type,
            'taggable_id' => $taggable_id,
        ]);
        $response
            ->assertStatus(Response::HTTP_CREATED)
            ->assertJson([
                'message' => __('general.created_successfully', ['model' => 'Tag'])
            ])->assertJsonStructure([
                'message', 'data'
            ]);
    }
    public function test_store_tag_with_null_data(): void
    {
        $response = $this->postJson(route('tag.store'), []);
        $response
            ->assertStatus(Response::HTTP_UNPROCESSABLE_ENTITY)
            ->assertJsonStructure([
                'message', 'errors'
            ]);
    }
    public function test_store_tag_with_invalid_data(): void
    {
        $response = $this->postJson(route('tag.store'), [
            'text' => fake()->randomNumber(),
            'taggable_type' => fake()->randomNumber(),
            'taggable_id' => fake()->word(),
        ]);
        $response
            ->assertStatus(Response::HTTP_UNPROCESSABLE_ENTITY)
            ->assertJsonStructure([
                'message', 'errors'
            ]);
    }
    public function test_store_tag_with_invalid_taggable_id(): void
    {
        $taggable_type = fake()->randomElement(TaggablesEnum::values());
        $response = $this->postJson(route('tag.store'), [
            'text' => fake()->word(),
            'taggable_type' => $taggable_type,
            'taggable_id' => 0,
        ]);
        $response
            ->assertStatus(Response::HTTP_UNPROCESSABLE_ENTITY)
            ->assertJsonStructure([
                'message', 'errors'
            ]);
    }

    //Show Tag Tests
    public function test_show_tag_successfully(): void
    {
        $tag = Tag::factory()->create();
        $response = $this->getJson(route('tag.show', ['id' => $tag->id]));
        $response
            ->assertStatus(Response::HTTP_OK)
            ->assertJson([
                'message' => __('general.fetched_successfully', ['model' => 'Tag'])
            ])->assertJsonStructure([
                'message', 'data'
            ]);
    }
    public function test_show_tag_with_invalid_id(): void
    {
        $response = $this->getJson(route('tag.show', ['id' => 0]));
        $response
            ->assertStatus(Response::HTTP_NOT_FOUND)
            ->assertJsonStructure([
                'message'
            ]);
    }

    //Index Tag Tests
    public function test_index_tag_successfully(): void
    {
        $response = $this->getJson(route('tag.index'));
        $response
            ->assertStatus(Response::HTTP_OK)
            ->assertJson([
                'message' => __('general.fetched_successfully', ['model' => 'Tag'])
            ])->assertJsonStructure([
                'message', 'data'
            ]);
    }
}
