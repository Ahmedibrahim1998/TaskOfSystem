<?php

namespace App\Http\Controllers;

use App\Application\Comment\DTOs\CreateCommentDTO;
use App\Application\Comment\UseCases\CreateCommentUseCase;
use App\Application\Comment\UseCases\ListCommentsUseCase;
use App\Http\Requests\StoreCommentRequest;
use App\Http\Resources\CommentCollection;
use App\Http\Resources\CommentResource;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Auth;

/**
 * Controller نحيف للتعليقات (طبقة Presentation).
 */
class CommentController extends Controller
{
    public function index(int $post, ListCommentsUseCase $listComments): CommentCollection
    {
        return new CommentCollection($listComments->execute($post, perPage: 10));
    }

    public function store(StoreCommentRequest $request, int $post, CreateCommentUseCase $createComment): JsonResponse
    {
        $comment = $createComment->execute(new CreateCommentDTO(
            userId: (int) Auth::id(),
            postId: $post,
            body: $request->validated()['body'],
        ));

        return response()->json([
            'message' => 'تم إضافة التعليق بنجاح',
            'data'    => new CommentResource($comment),
        ], 201);
    }
}
