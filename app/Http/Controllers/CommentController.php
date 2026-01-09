<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use App\Http\Requests\StoreCommentRequest;
use App\Models\Post;
use Illuminate\Http\JsonResponse;
use App\Http\Resources\CommentResource;

class CommentController extends Controller
{
  public function index(int $postId): \App\Http\Resources\CommentCollection
    {
        $comments = Comment::with(['user', 'post'])
            ->where('post_id', $postId)
            ->latest()
            ->paginate(10);
            
        return new \App\Http\Resources\CommentCollection($comments);
    }

    public function store(StoreCommentRequest $request, Post $post): JsonResponse
    {
        $comment = Comment::create([
            'user_id' => auth()->id(),
            'post_id' => $post->id,     // ← هنا بنستخدم $post->id
            'body'    => $request->body
        ]);

        return response()->json([
            'message' => 'تم إضافة التعليق بنجاح',
            'data'    => new CommentResource($comment->load('user'))
        ], 201);
    }
}
