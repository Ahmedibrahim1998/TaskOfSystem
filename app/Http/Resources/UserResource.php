<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Carbon;

/**
 * @mixin \App\Models\User
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
            'created_at' => $this->created_at?->format('Y-m-d H:i:s'),
            // أو لو عايز تنسيق أفضل ومتوافق مع ISO:
            // 'created_at' => $this->created_at instanceof Carbon
            //     ? $this->created_at->toDateTimeString()
            //     : null,
        ];
    }
}