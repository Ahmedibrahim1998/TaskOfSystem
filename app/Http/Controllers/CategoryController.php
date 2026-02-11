<?php

namespace App\Http\Controllers;

use Illuminate\Http\JsonResponse;
use Symfony\Component\HttpFoundation\Response;

class CategoryController extends Controller
{
  public function index(): JsonResponse
    {
       $catgeories = [
            [
                "id" => 1,
                "name" => "Ahmed",
                "age" => 20
            ],
            [
                "id" => 1,
                "name" => "mohamed",
                "age" => 50
            ],
            [
                "id" => 1,
                "name" => "zahraa",
                "age" => 23
            ],
        ];

        return response()->json($catgeories);
    }
}
