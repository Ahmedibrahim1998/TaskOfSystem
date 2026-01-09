<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

/**
 * @mixin \App\Models\Comment
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
            'user'       => new UserResource($this->whenLoaded('user')),
            'created_at' => $this->created_at?->format('Y-m-d H:i:s'),
            // أو تنسيق أفضل وأكثر احترافية:
            // 'created_at' => $this->created_at?->toDateTimeString(),
        ];
    }
}