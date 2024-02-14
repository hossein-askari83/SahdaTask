<?php

namespace Tests\Unit;

use App\Models\Author;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Symfony\Component\HttpFoundation\Response;
use Tests\TestCase;

class AuthorControllerTest extends TestCase
{
    use RefreshDatabase;

    //Store Author Tests
    public function test_store_author_successfully(): void
    {
        $response = $this->postJson(route('author.store'), [
            'name' => fake()->name(),
        ]);
        $response
            ->assertStatus(Response::HTTP_CREATED)
            ->assertJson([
                'message' => __('general.created_successfully', ['model' => 'Author'])
            ])->assertJsonStructure([
                'message', 'data'
            ]);
    }
    public function test_store_author_with_null_data(): void
    {
        $response = $this->postJson(route('author.store'), []);
        $response
            ->assertStatus(Response::HTTP_UNPROCESSABLE_ENTITY)
            ->assertJsonStructure([
                'message', 'errors'
            ]);
    }
    public function test_store_author_with_invalid_data(): void
    {
        $response = $this->postJson(route('author.store'), [
            'name' => fake()->randomNumber(),
        ]);
        $response
            ->assertStatus(Response::HTTP_UNPROCESSABLE_ENTITY)
            ->assertJsonStructure([
                'message', 'errors'
            ]);
    }

    //Show Author Tests
    public function test_show_author_successfully(): void
    {
        $author = Author::factory()->create();
        $response = $this->getJson(route('author.show', ['id' => $author->id]));
        $response
            ->assertStatus(Response::HTTP_OK)
            ->assertJson([
                'message' => __('general.fetched_successfully', ['model' => 'Author'])
            ])->assertJsonStructure([
                'message', 'data'
            ]);
    }
    public function test_show_Author_with_invalid_id(): void
    {
        $response = $this->getJson(route('author.show', ['id' => 0]));
        $response
            ->assertStatus(Response::HTTP_NOT_FOUND)
            ->assertJsonStructure([
                'message'
            ]);
    }

    //Index Author Tests
    public function test_index_author_successfully(): void
    {
        $response = $this->getJson(route('author.index'));
        $response
            ->assertStatus(Response::HTTP_OK)
            ->assertJson([
                'message' => __('general.fetched_successfully', ['model' => 'Author'])
            ])->assertJsonStructure([
                'message', 'data'
            ]);
    }
    public function test_index_author_with_tag(): void
    {
        $response = $this->getJson(route('author.index', ['tag' => fake()->word()]));
        $response
            ->assertStatus(Response::HTTP_OK)
            ->assertJson([
                'message' => __('general.fetched_successfully', ['model' => 'Author'])
            ])->assertJsonStructure([
                'message', 'data'
            ]);
    }
}
