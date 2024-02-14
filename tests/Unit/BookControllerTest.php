<?php

namespace Tests\Unit;

use App\Models\Author;
use App\Models\Book;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Symfony\Component\HttpFoundation\Response;
use Tests\TestCase;

class BookControllerTest extends TestCase
{
    use RefreshDatabase;

    //Store Book Tests
    public function test_store_book_successfully(): void
    {
        $author = Author::factory()->create();
        $response = $this->postJson(route('book.store'), [
            'title' => fake()->word(),
            'author_id' => $author->id,
            'price' => fake()->randomNumber(),
        ]);
        $response
            ->assertStatus(Response::HTTP_CREATED)
            ->assertJson([
                'message' => __('general.created_successfully', ['model' => 'Book'])
            ])->assertJsonStructure([
                'message', 'data'
            ]);
    }
    public function test_store_book_with_null_data(): void
    {
        $response = $this->postJson(route('book.store'), []);
        $response
            ->assertStatus(Response::HTTP_UNPROCESSABLE_ENTITY)
            ->assertJsonStructure([
                'message', 'errors'
            ]);
    }
    public function test_store_book_with_invalid_data(): void
    {
        $response = $this->postJson(route('book.store'), [
            'title' => fake()->randomNumber(),
            'author_id' => 0,
            'price' => fake()->word(),
        ]);
        $response
            ->assertStatus(Response::HTTP_UNPROCESSABLE_ENTITY)
            ->assertJsonStructure([
                'message', 'errors'
            ]);
    }

    //Update Book Tests
    public function test_update_book_successfully(): void
    {
        $book = Book::factory()->create();
        $author = Author::factory()->create();
        $response = $this->putJson(route('book.update', ['id' => $book->id]), [
            'title' => fake()->word(),
            'author_id' => $author->id,
            'price' => fake()->randomNumber(),
        ]);
        $response
            ->assertStatus(Response::HTTP_OK)
            ->assertJson([
                'message' => __('general.updated_successfully', ['model' => 'Book'])
            ])->assertJsonStructure([
                'message', 'data'
            ]);
    }
    public function test_update_book_with_null_data(): void
    {
        $book = Book::factory()->create();
        $response = $this->putJson(route('book.update', ['id' => $book->id]), []);
        $response
            ->assertStatus(Response::HTTP_OK)
            ->assertJson([
                'message' => __('general.updated_successfully', ['model' => 'Book'])
            ])->assertJsonStructure([
                'message', 'data'
            ]);
    }
    public function test_update_book_with_invalid_id(): void
    {
        $author = Author::factory()->create();
        $response = $this->putJson(route('book.update', ['id' => 0]), [
            'title' => fake()->word(),
            'author_id' => $author->id,
            'price' => fake()->randomNumber(),
        ]);
        $response
            ->assertStatus(Response::HTTP_NOT_FOUND)
            ->assertJsonStructure([
                'message',
            ]);
    }
    public function test_update_book_with_invalid_data(): void
    {
        $book = Book::factory()->create();
        $response = $this->putJson(route('book.update', ['id' => $book->id]), [
            'title' => fake()->randomNumber(),
            'author_id' => 0,
            'price' => fake()->word(),
        ]);
        $response
            ->assertStatus(Response::HTTP_UNPROCESSABLE_ENTITY)
            ->assertJsonStructure([
                'message', 'errors'
            ]);
    }

    //Show Book Tests
    public function test_show_book_successfully(): void
    {
        $book = Book::factory()->create();
        $response = $this->getJson(route('book.show', ['id' => $book->id]));
        $response
            ->assertStatus(Response::HTTP_OK)
            ->assertJson([
                'message' => __('general.fetched_successfully', ['model' => 'Book'])
            ])->assertJsonStructure([
                'message', 'data'
            ]);
    }
    public function test_show_book_with_invalid_id(): void
    {
        $response = $this->getJson(route('book.show', ['id' => 0]));
        $response
            ->assertStatus(Response::HTTP_NOT_FOUND)
            ->assertJsonStructure([
                'message'
            ]);
    }

    //Index Book Tests
    public function test_index_book_successfully(): void
    {
        $response = $this->getJson(route('book.index'));
        $response
            ->assertStatus(Response::HTTP_OK)
            ->assertJson([
                'message' => __('general.fetched_successfully', ['model' => 'Book'])
            ])->assertJsonStructure([
                'message', 'data'
            ]);
    }
    public function test_index_book_with_tag(): void
    {
        $response = $this->getJson(route('book.index', ['tag' => fake()->word()]));
        $response
            ->assertStatus(Response::HTTP_OK)
            ->assertJson([
                'message' => __('general.fetched_successfully', ['model' => 'Book'])
            ])->assertJsonStructure([
                'message', 'data'
            ]);
    }
}
