<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;    
use App\Models\Post;
use App\Http\Resources\PostResource;
use App\Http\Requests\StorePostRequest;
use App\Http\Requests\UpdatePostRequest;
use Illuminate\Support\Facades\Auth;

class PostsController extends Controller
{
    public function index(): \App\Http\Resources\PostCollection
    {
        $posts = Post::with(['user', 'comments.user'])->latest()->paginate(10);
        return PostResource::collection($posts);
    }

    public function store(StorePostRequest $request): \Illuminate\Http\JsonResponse
    {
        $post = Auth::user()->posts()->create($request->validated());

        return response()->json([
            'message' => 'تم إنشاء المنشور بنجاح',
            'data' => new PostResource($post->load('user', 'comments'))
        ], 201);
    }

    public function show(Post $post): \App\Http\Resources\PostResource
    {
        return new PostResource($post->load(['user', 'comments.user']));
    }

   public function update(UpdatePostRequest $request, Post $post): \Illuminate\Http\JsonResponse
    {
        
        $post->update($request->validated());

        return response()->json([
            'message' => 'تم تحديث المنشور بنجاح',
            'data' => new PostResource($post->load('user', 'comments'))
        ]);     
    }
    
    public function destroy(Post $post): \Illuminate\Http\JsonResponse
    {
        $post->delete();
        return response()->json([
            'message' => 'تم حذف المنشور بنجاح'
        ], 200);
    }
}
