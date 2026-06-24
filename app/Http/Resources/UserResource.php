<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

/**
 * بيحوّل كيان الـ Domain (UserEntity) لمصفوفة استجابة JSON.
 *
 * @mixin \App\Domain\User\Entities\UserEntity
 */
class UserResource extends JsonResource
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
            'name'       => $this->name,
            'email'      => $this->email,
            'created_at' => $this->createdAt?->format('Y-m-d H:i:s'),
        ];
    }
}
