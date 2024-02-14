<?php

namespace App\Http\Controllers\API\V1;

use App\DataTransferObjects\TagDTO;
use App\Http\Controllers\Controller;
use App\Http\Requests\Tag\StoreTagRequest;
use App\Http\Resources\TagResource;
use App\Models\Tag;
use App\Services\TagService;
use Illuminate\Http\JsonResponse;
use Symfony\Component\HttpFoundation\Response;

class TagController extends Controller
{
    public function __construct(protected TagService $service)
    {
    }

    public function store(StoreTagRequest $request): JsonResponse
    {
        $tag = $this->service->store(TagDTO::fromRequest($request));
        $message = __('general.created_successfully', ['model' => class_basename(Tag::class)]);
        return response()->json(['message' => $message, 'data' => TagResource::make($tag)], Response::HTTP_CREATED);
    }

    public function index(): JsonResponse
    {
        $tags = $this->service->index();
        $message = __('general.fetched_successfully', ['model' => class_basename(Tag::class)]);
        return response()->json(['message' => $message, 'data' => TagResource::collection($tags)], Response::HTTP_OK);
    }

    public function show(int $id): JsonResponse
    {
        $tag = $this->service->show($id);
        $message = __('general.fetched_successfully', ['model' => class_basename(Tag::class)]);
        return response()->json(['message' => $message, 'data' => TagResource::make($tag)], Response::HTTP_OK);
    }
}
