<?php

namespace App\DTOs;

/**
 * كائن نقل بيانات (DTO) لإنشاء منشور.
 *
 * بيغلّف بيانات المنشور في نوع صريح بدل تمرير مصفوفة عامة للـ Service،
 * فيوضّح الحقول المطلوبة ويمنع تمرير مفاتيح عشوائية.
 */
final class PostData
{
    public function __construct(
        public readonly string $title,
        public readonly string $content,
        public readonly string $slug,
    ) {
    }

    /**
     * ينشئ الـ DTO من مصفوفة بيانات مُتحقَّق منها.
     *
     * @param  array<string, mixed>  $data
     */
    public static function fromArray(array $data): self
    {
        return new self(
            title: (string) $data['title'],
            content: (string) $data['content'],
            slug: (string) $data['slug'],
        );
    }

    /**
     * يحوّل الـ DTO لمصفوفة جاهزة للتخزين في الـ Repository.
     *
     * @return array<string, mixed>
     */
    public function toArray(): array
    {
        return [
            'title'   => $this->title,
            'content' => $this->content,
            'slug'    => $this->slug,
        ];
    }
}
