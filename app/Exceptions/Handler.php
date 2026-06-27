<?php

namespace App\Exceptions;

use App\Domain\Auth\Exceptions\InvalidCredentialsException;
use App\Domain\Post\Exceptions\PostNotFoundException;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Illuminate\Http\JsonResponse;
use Throwable;

class Handler extends ExceptionHandler
{
    /**
     * A list of the exception types that are not reported.
     *
     * @var array<int, class-string<Throwable>>
     */
    protected $dontReport = [
        //
    ];

    /**
     * A list of the inputs that are never flashed for validation exceptions.
     *
     * @var array<int, string>
     */
    protected $dontFlash = [
        'current_password',
        'password',
        'password_confirmation',
    ];

    /**
     * Register the exception handling callbacks for the application.
     *
     * @return void
     */
    public function register()
    {
        $this->reportable(function (Throwable $e) {
            //
        });

        // ترجمة استثناءات الـ Domain لاستجابات HTTP مناسبة — وده مكان حدود
        // طبقة الـ Presentation: الـ Domain بيرمي استثناء نقي، وهنا بنحوّله لـ 404.
        $this->renderable(function (PostNotFoundException $e): JsonResponse {
            return response()->json([
                'message' => $e->getMessage(),
            ], 404);
        });

        // بيانات دخول غير صحيحة => 422 (زي سلوك ValidationException الأصلي)
        $this->renderable(function (InvalidCredentialsException $e): JsonResponse {
            return response()->json([
                'message' => $e->getMessage(),
                'errors'  => ['email' => [$e->getMessage()]],
            ], 422);
        });
    }
}
