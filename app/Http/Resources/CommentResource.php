<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

/**
 * بيحوّل كيان الـ Domain (CommentEntity) لمصفوفة استجابة JSON.
 *
 * @mixin \App\Domain\Comment\Entities\CommentEntity
 */
class CommentResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array<string, mixed>
     */
    public function toArray($request): array
    {
        return [
            'id'         => $this->id,
            'body'       => $this->body,
            'user'       => $this->user !== null ? new UserResource($this->user) : null,
            'created_at' => $this->createdAt?->format('Y-m-d H:i:s'),
        ];
    }
}
