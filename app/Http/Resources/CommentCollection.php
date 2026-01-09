<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\ResourceCollection;

class CommentCollection extends ResourceCollection
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
            'data' => $this->collection, // Laravel هيحول كل Comment إلى CommentResource تلقائيًا

            'links' => [
                'first' => $this->url(1),
                'last'  => $this->url($this->lastPage()),
                'prev'  => $this->previousPageUrl(),  // string|null
                'next'  => $this->nextPageUrl(),      // string|null
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
}