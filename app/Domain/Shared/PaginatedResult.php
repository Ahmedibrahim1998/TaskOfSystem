<?php

namespace App\Domain\Shared;

/**
 * Value Object يمثّل نتيجة مقسّمة لصفحات (Pagination) بشكل مستقل عن Laravel.
 *
 * الطبقة الأعلى (Application/Domain) ترجّع الكيانات + بيانات الصفحات من غير ما
 * تعرف أي حاجة عن LengthAwarePaginator بتاع Eloquent. الـ Mapper في طبقة
 * Infrastructure هو اللي بيحوّل من Paginator لهذا الكائن.
 *
 * @template T
 */
final class PaginatedResult
{
    /**
     * @param  list<T>  $items   عناصر الصفحة الحالية (كيانات الـ Domain)
     * @param  int  $total       إجمالي عدد العناصر في كل الصفحات
     * @param  int  $perPage     عدد العناصر في الصفحة الواحدة
     * @param  int  $currentPage رقم الصفحة الحالية
     * @param  int  $lastPage    رقم آخر صفحة
     */
    public function __construct(
        public readonly array $items,
        public readonly int $total,
        public readonly int $perPage,
        public readonly int $currentPage,
        public readonly int $lastPage,
    ) {
    }
}
