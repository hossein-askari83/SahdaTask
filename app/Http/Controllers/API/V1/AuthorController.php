<?php

namespace App\Http\Controllers\API\V1;

use App\DataTransferObjects\AuthorDTO;
use App\Http\Controllers\Controller;
use App\Http\Requests\Author\StoreAuthorRequest;
use App\Http\Resources\AuthorResource;
use App\Models\Author;
use App\Services\AuthorService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class AuthorController extends Controller
{
    public function __construct(protected AuthorService $service)
    {
    }

    public function store(StoreAuthorRequest $request): JsonResponse
    {
        $author = $this->service->store(AuthorDTO::fromRequest($request));
        $message = __('general.created_successfully', ['model' => class_basename(Author::class)]);
        return response()->json(['message' => $message, 'data' => AuthorResource::make($author)], Response::HTTP_CREATED);
    }

    public function index(Request $request): JsonResponse
    {
        $tag = $request->get('tag');
        $authors = $this->service->index($tag);
        $message = __('general.fetched_successfully', ['model' => class_basename(Author::class)]);
        return response()->json(['message' => $message, 'data' => AuthorResource::collection($authors)], Response::HTTP_OK);
    }

    public function show(int $id): JsonResponse
    {
        $author = $this->service->show($id);
        $message = __('general.fetched_successfully', ['model' => class_basename(Author::class)]);
        return response()->json(['message' => $message, 'data' => AuthorResource::make($author)], Response::HTTP_OK);
    }
}
