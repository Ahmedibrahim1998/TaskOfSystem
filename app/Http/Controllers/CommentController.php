<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreCommentRequest;
use App\Http\Resources\CommentCollection;
use App\Http\Resources\CommentResource;
use App\Models\Post;
use App\Services\CommentService;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Auth;

/**
 * Controller نحيف للتعليقات: بينادي CommentService.
 */
class CommentController extends Controller
{
    public function __construct(
        private readonly CommentService $comments,
    ) {
    }

    public function index(Post $post): CommentCollection
    {
        return new CommentCollection($this->comments->listForPost($post->id, 10));
    }

    public function store(StoreCommentRequest $request, Post $post): JsonResponse
    {
        $comment = $this->comments->create((int) Auth::id(), $post->id, $request->validated()['body']);

        return response()->json([
            'message' => 'تم إضافة التعليق بنجاح',
            'data'    => new CommentResource($comment),
        ], 201);
    }
}
