<?php

namespace App\Http\Controllers\API\V1;

use App\DataTransferObjects\BookDTO;
use App\Http\Controllers\Controller;
use App\Http\Requests\Book\StoreBookRequest;
use App\Http\Requests\Book\UpdateBookRequest;
use App\Http\Resources\BookResource;
use App\Models\Book;
use App\Services\BookService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class BookController extends Controller
{
    public function __construct(protected BookService $service)
    {
    }

    public function store(StoreBookRequest $request): JsonResponse
    {
        $book = $this->service->store(BookDTO::fromRequest($request));
        $message = __('general.created_successfully', ['model' => class_basename(Book::class)]);
        return response()->json(['message' => $message, 'data' => BookResource::make($book)], Response::HTTP_CREATED);
    }

    public function update(UpdateBookRequest $request, int $id): JsonResponse
    {
        $book = $this->service->update(BookDTO::fromRequest($request), $id);
        $message = __('general.updated_successfully', ['model' => class_basename(Book::class)]);
        return response()->json(['message' => $message, 'data' => BookResource::make($book)], Response::HTTP_OK);
    }

    public function index(Request $request): JsonResponse
    {
        $tag = $request->get('tag');
        $books = $this->service->index($tag);
        $message = __('general.fetched_successfully', ['model' => class_basename(Book::class)]);
        return response()->json(['message' => $message, 'data' => BookResource::collection($books)], Response::HTTP_OK);
    }

    public function show(int $id): JsonResponse
    {
        $book = $this->service->show($id);
        $message = __('general.fetched_successfully', ['model' => class_basename(Book::class)]);
        return response()->json(['message' => $message, 'data' => BookResource::make($book)], Response::HTTP_OK);
    }
}
