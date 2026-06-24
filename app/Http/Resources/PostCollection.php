<?php

namespace App\Http\Resources;

use App\Domain\Post\Entities\PostEntity;
use App\Domain\Shared\PaginatedResult;
use Illuminate\Http\Resources\Json\JsonResource;

/**
 * بيحوّل نتيجة مقسّمة لصفحات (PaginatedResult من طبقة الـ Domain) لاستجابة JSON
 * فيها بيانات المنشورات + معلومات الصفحات.
 *
 * @mixin \App\Domain\Shared\PaginatedResult<\App\Domain\Post\Entities\PostEntity>
 */
class PostCollection extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array<string, mixed>
     */
    public function toArray($request): array
    {
        /** @var PaginatedResult<PostEntity> $result */
        $result = $this->resource;

        return [
            'data' => array_map(
                static fn (PostEntity $post): PostResource => new PostResource($post),
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
