<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use App\Http\Requests\StoreCommentRequest;
use Illuminate\Http\Request;
use App\Http\Resources\CommentResource;

class CommentController extends Controller
{
   public function index($postId)
    {
        $comments = Comment::with(['user', 'post'])
            ->where('post_id', $postId)
            ->latest()
            ->paginate(10);
            
        return new \App\Http\Resources\CommentCollection($comments);
    }

    public function store(StoreCommentRequest $request, $postId)
    {
        $comment = Comment::create([
            'user_id' => auth()->id(),
            'post_id' => $postId,
            'body' => $request->body
        ]);
        return response()->json([
            'message' => 'تم إضافة التعليق بنجاح',
            'data' => new CommentResource($comment->load('user'))
        ], 201);
    }
}
