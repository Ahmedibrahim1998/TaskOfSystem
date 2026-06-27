<?php

namespace App\Http\Controllers;

use App\Actions\Comments\CreateCommentAction;
use App\Actions\Comments\ListCommentsAction;
use App\Http\Requests\StoreCommentRequest;
use App\Http\Resources\CommentCollection;
use App\Http\Resources\CommentResource;
use App\Models\Post;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Auth;

/**
 * Controller نحيف للتعليقات: كل ميثود بتنادي Action واحد.
 */
class CommentController extends Controller
{
    public function index(Post $post, ListCommentsAction $action): CommentCollection
    {
        return new CommentCollection($action->execute($post->id, 10));
    }

    public function store(StoreCommentRequest $request, Post $post, CreateCommentAction $action): JsonResponse
    {
        $comment = $action->execute((int) Auth::id(), $post->id, $request->validated()['body']);

        return response()->json([
            'message' => 'تم إضافة التعليق بنجاح',
            'data'    => new CommentResource($comment),
        ], 201);
    }
}
