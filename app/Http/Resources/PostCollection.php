<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\ResourceCollection;

class PostCollection extends ResourceCollection
{
    /**
     * Transform the resource collection into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array<string, mixed>
     */
    public function toArray($request): array
    {
        return [
            'data' => $this->collection, // Laravel هيحول كل عنصر إلى PostResource تلقائيًا

            'links' => [
                'self' => url()->current(),
                'next' => $this->nextPageUrl(),      // string|null
                'prev' => $this->previousPageUrl(),  // string|null
            ],

            'meta' => [
                'current_page' => $this->currentPage(),
                'from'         => $this->firstItem(),
                'last_page'    => $this->lastPage(),
                'path'         => $this->path(),
                'per_page'     => $this->perPage(),
                'to'           => $this->lastItem(),
                'total'        => $this->total(),
            ],
        ];
    }

    /**
     * لو عايز تضيف pagination info إضافية أو تغير الهيكل، ممكن تستخدم with() بدلاً من كتابة الكود يدويًا
     *
     * مثال أنظف (اختياري):
     *
     * public function with($request): array
     * {
     *     return [
     *         'links' => $this->paginationLinks(),
     *         'meta'  => $this->paginationMeta(),
     *     ];
     * }
     *
     * لكن الكود الحالي ممتاز وشائع جدًا.
     */
}