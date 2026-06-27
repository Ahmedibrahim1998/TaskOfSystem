<?php

namespace App\Http\Resources;

use App\Domain\Comment\Entities\CommentEntity;
use App\Domain\Shared\PaginatedResult;
use Illuminate\Http\Resources\Json\JsonResource;

/**
 * بيحوّل نتيجة تعليقات مقسّمة لصفحات (PaginatedResult) لاستجابة JSON.
 *
 * @mixin \App\Domain\Shared\PaginatedResult<\App\Domain\Comment\Entities\CommentEntity>
 */
class CommentCollection extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array<string, mixed>
     */
    public function toArray($request): array
    {
        /** @var PaginatedResult<CommentEntity> $result */
        $result = $this->resource;

        return [
            'data' => array_map(
                static fn (CommentEntity $comment): CommentResource => new CommentResource($comment),
                $result->items,
            ),
            'meta' => [
                'current_page' => $result->currentPage,
                'last_page'    => $result->lastPage,
                'per_page'     => $result->perPage,
                'total'        => $result->total,
            ],
        ];
    }
}
