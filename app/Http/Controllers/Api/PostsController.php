<?php

namespace App\Http\Controllers\Api;

use App\Application\Post\DTOs\CreatePostDTO;
use App\Application\Post\DTOs\UpdatePostDTO;
use App\Application\Post\UseCases\CreatePostUseCase;
use App\Application\Post\UseCases\DeletePostUseCase;
use App\Application\Post\UseCases\ListPostsUseCase;
use App\Application\Post\UseCases\ShowPostUseCase;
use App\Application\Post\UseCases\UpdatePostUseCase;
use App\Http\Controllers\Controller;
use App\Http\Requests\StorePostRequest;
use App\Http\Requests\UpdatePostRequest;
use App\Http\Resources\PostCollection;
use App\Http\Resources\PostResource;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Auth;

/**
 * Controller نحيف (طبقة Presentation): مسؤوليته بس تحويل الـ HTTP request
 * لاستدعاء Use Case، وتغليف النتيجة في Resource. كل منطق العمل في طبقة Application.
 */
class PostsController extends Controller
{
    public function index(ListPostsUseCase $listPosts): PostCollection
    {
        return new PostCollection($listPosts->execute(perPage: 10));
    }

    public function store(StorePostRequest $request, CreatePostUseCase $createPost): JsonResponse
    {
        $validated = $request->validated();

        $post = $createPost->execute(new CreatePostDTO(
            userId: (int) Auth::id(),
            title: $validated['title'],
            slug: $validated['slug'],
            content: $validated['content'],
        ));

        return response()->json([
            'message' => 'تم إنشاء المنشور بنجاح',
            'data'    => new PostResource($post),
        ], 201);
    }

    public function show(int $post, ShowPostUseCase $showPost): PostResource
    {
        return new PostResource($showPost->execute($post));
    }

    public function update(UpdatePostRequest $request, int $post, UpdatePostUseCase $updatePost): JsonResponse
    {
        $validated = $request->validated();

        $updated = $updatePost->execute($post, new UpdatePostDTO(
            title: $validated['title'] ?? null,
            slug: $validated['slug'] ?? null,
            content: $validated['content'] ?? null,
        ));

        return response()->json([
            'message' => 'تم تحديث المنشور بنجاح',
            'data'    => new PostResource($updated),
        ]);
    }

    public function destroy(int $post, DeletePostUseCase $deletePost): JsonResponse
    {
        $deletePost->execute($post);

        return response()->json([
            'message' => 'تم حذف المنشور بنجاح',
        ]);
    }
}
