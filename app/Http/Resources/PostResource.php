<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

/**
 * @mixin \App\Models\Post
 */
class PostResource extends JsonResource
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
            'title'      => $this->title,
            'slug'       => $this->slug,
            'content'    => $this->content,
            'user'       => new UserResource($this->whenLoaded('user')),
            'comments'   => CommentResource::collection($this->whenLoaded('comments')),
            'created_at' => $this->created_at?->format('Y-m-d H:i:s'),
            'updated_at' => $this->updated_at?->format('Y-m-d H:i:s'),
        ];
    }

    /**
     * Customize the collection resource class.
     *
     * @param  mixed  $resource
     * @return PostCollection
     */
    public static function collection($resource): PostCollection
    {
        return new PostCollection($resource);
    }
}