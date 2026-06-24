<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\StorePostRequest;
use App\Http\Requests\UpdatePostRequest;
use App\Http\Resources\PostCollection;
use App\Http\Resources\PostResource;
use App\Models\Post;
use App\Services\PostService;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Auth;

/**
 * Controller نحيف للمنشورات: بينادي PostService ويغلّف الناتج في Resource.
 * منطق العمل في الـ Service، والوصول للبيانات في الـ Repository.
 */
class PostsController extends Controller
{
    public function __construct(
        private readonly PostService $posts,
    ) {
    }

    public function index(): PostCollection
    {
        return PostResource::collection($this->posts->list(10));
    }

    public function store(StorePostRequest $request): JsonResponse
    {
        $post = $this->posts->create((int) Auth::id(), $request->validated());

        return response()->json([
            'message' => 'تم إنشاء المنشور بنجاح',
            'data'    => new PostResource($post),
        ], 201);
    }

    public function show(Post $post): PostResource
    {
        return new PostResource($this->posts->show($post));
    }

    public function update(UpdatePostRequest $request, Post $post): JsonResponse
    {
        $post = $this->posts->update($post, $request->validated());

        return response()->json([
            'message' => 'تم تحديث المنشور بنجاح',
            'data'    => new PostResource($post),
        ]);
    }

    public function destroy(Post $post): JsonResponse
    {
        $this->posts->delete($post);

        return response()->json([
            'message' => 'تم حذف المنشور بنجاح',
        ]);
    }
}
