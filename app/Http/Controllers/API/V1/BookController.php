<?php

namespace App\Http\Controllers\API\V1;

use App\DataTransferObjects\BookDTO;
use App\Http\Controllers\Controller;
use App\Http\Requests\Book\StoreBookRequest;
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
        return response()->json(['message' => $message, BookResource::make($book)], Response::HTTP_CREATED);
    }
}
