<?php

namespace App\Http\Controllers\Api;

use App\Actions\Posts\CreatePostAction;
use App\Actions\Posts\DeletePostAction;
use App\Actions\Posts\ListPostsAction;
use App\Actions\Posts\ShowPostAction;
use App\Actions\Posts\UpdatePostAction;
use App\Http\Controllers\Controller;
use App\Http\Requests\StorePostRequest;
use App\Http\Requests\UpdatePostRequest;
use App\Http\Resources\PostCollection;
use App\Http\Resources\PostResource;
use App\Models\Post;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Auth;

/**
 * Controller نحيف للمنشورات: كل ميثود بتنادي Action واحد (Method Injection).
 */
class PostsController extends Controller
{
    public function index(ListPostsAction $action): PostCollection
    {
        return PostResource::collection($action->execute(10));
    }

    public function store(StorePostRequest $request, CreatePostAction $action): JsonResponse
    {
        $post = $action->execute((int) Auth::id(), $request->validated());

        return response()->json([
            'message' => 'تم إنشاء المنشور بنجاح',
            'data'    => new PostResource($post),
        ], 201);
    }

    public function show(Post $post, ShowPostAction $action): PostResource
    {
        return new PostResource($action->execute($post));
    }

    public function update(UpdatePostRequest $request, Post $post, UpdatePostAction $action): JsonResponse
    {
        $post = $action->execute($post, $request->validated());

        return response()->json([
            'message' => 'تم تحديث المنشور بنجاح',
            'data'    => new PostResource($post),
        ]);
    }

    public function destroy(Post $post, DeletePostAction $action): JsonResponse
    {
        $action->execute($post);

        return response()->json([
            'message' => 'تم حذف المنشور بنجاح',
        ]);
    }
}
