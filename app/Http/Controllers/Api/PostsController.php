<?php

namespace App\Http\Controllers\Api;

use App\DTOs\PostData;
use App\Http\Controllers\Controller;
use App\Http\Requests\StorePostRequest;
use App\Http\Requests\UpdatePostRequest;
use App\Http\Resources\PostCollection;
use App\Http\Resources\PostResource;
use App\Http\Responses\ApiResponse;
use App\Models\Post;
use App\Services\PostService;
use App\Services\UserService;

/**
 * Controller نحيف للمنشورات: بينادي PostService ويغلّف الناتج في Resource.
 * منطق العمل في الـ Service، والوصول للبيانات في الـ Repository.
 */
class PostsController extends Controller
{
    public function __construct(
        private readonly PostService $posts,
        private readonly UserService $users,
    ) {
    }

    public function index(): PostCollection
    {
        return PostResource::collection($this->posts->list(10));
    }

    public function store(StorePostRequest $request): ApiResponse
    {
        $post = $this->posts->create($this->users->current(), PostData::fromArray($request->validated()));

        return ApiResponse::success('تم إنشاء المنشور بنجاح', new PostResource($post), 201);
    }

    public function show(Post $post): PostResource
    {
        return new PostResource($this->posts->show($post));
    }

    public function update(UpdatePostRequest $request, Post $post): ApiResponse
    {
        $post = $this->posts->update($post, $request->validated());

        return ApiResponse::success('تم تحديث المنشور بنجاح', new PostResource($post));
    }

    public function destroy(Post $post): ApiResponse
    {
        $this->posts->delete($post);

        return ApiResponse::success('تم حذف المنشور بنجاح');
    }
}
