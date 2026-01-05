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

    public function index()
    {
        $posts = Post::with(['user', 'comments.user'])->latest()->paginate(10);
        return PostResource::collection($posts);
    }

    public function store(StorePostRequest $request)
    {
        $post = Auth::user()->posts()->create($request->validated());

        return response()->json([
            'message' => 'تم إنشاء المنشور بنجاح',
            'data' => new PostResource($post->load('user', 'comments'))
        ], 201);
    }

    public function show(Post $post)
    {
        return new PostResource($post->load(['user', 'comments.user']));
    }

   public function update(UpdatePostRequest $request, Post $post)
    {
        // Remove the policy check and add direct authorization
        if (auth()->id() !== $post->user_id) {
            return response()->json([
                'message' => 'غير مصرح لك بتحديث هذا المنشور'
            ], 403);
        }
        
        $post->update($request->validated());

        return response()->json([
            'message' => 'تم تحديث المنشور بنجاح',
            'data' => new PostResource($post->load('user', 'comments'))
        ]);     
    }
    
    public function destroy(Post $post)
    {
        $post->delete();
        return response()->json([
            'message' => 'تم حذف المنشور بنجاح'
        ], 200);
    }
}
