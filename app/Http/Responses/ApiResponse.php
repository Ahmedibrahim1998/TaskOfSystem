<?php

namespace App\Http\Responses;

use Illuminate\Contracts\Support\Responsable;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

/**
 * كائن استجابة موحّد لواجهة الـ API.
 *
 * بيغلّف بناء الـ JSON response في مكان واحد بدل تكرار response()->json([...])
 * في كل ميثود. أي كلاس بيطبّق Responsable ينفع نرجّعه مباشرة من الكنترولر
 * وLaravel بيحوّله لاستجابة عن طريق toResponse().
 */
final class ApiResponse implements Responsable
{
    /**
     * @param  array<string, mixed>  $payload  حقول إضافية تُدمج في جسم الاستجابة.
     */
    public function __construct(
        private readonly ?string $message = null,
        private readonly array $payload = [],
        private readonly int $status = 200,
    ) {
    }

    /**
     * استجابة نجاح بالشكل الشائع { message, data }.
     */
    public static function success(string $message, mixed $data = null, int $status = 200): self
    {
        return new self(
            message: $message,
            payload: $data !== null ? ['data' => $data] : [],
            status: $status,
        );
    }

    /**
     * @param  Request  $request
     */
    public function toResponse($request): JsonResponse
    {
        $body = [];

        if ($this->message !== null) {
            $body['message'] = $this->message;
        }

        return response()->json($body + $this->payload, $this->status);
    }
}
