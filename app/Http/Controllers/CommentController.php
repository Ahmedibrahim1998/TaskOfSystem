<?php

namespace App\Http\Controllers;

use App\DTOs\CommentData;
use App\Http\Requests\StoreCommentRequest;
use App\Http\Resources\CommentCollection;
use App\Http\Resources\CommentResource;
use App\Http\Responses\ApiResponse;
use App\Models\Post;
use App\Services\CommentService;
use App\Services\UserService;

/**
 * Controller نحيف للتعليقات: بينادي CommentService.
 */
class CommentController extends Controller
{
    public function __construct(
        private readonly CommentService $comments,
        private readonly UserService $users,
    ) {
    }

    public function index(Post $post): CommentCollection
    {
        return new CommentCollection($this->comments->listForPost($post->id, 10));
    }

    public function store(StoreCommentRequest $request, Post $post): ApiResponse
    {
        $comment = $this->comments->create($this->users->current(), $post, CommentData::fromArray($request->validated()));

        return ApiResponse::success('تم إضافة التعليق بنجاح', new CommentResource($comment), 201);
    }
}
