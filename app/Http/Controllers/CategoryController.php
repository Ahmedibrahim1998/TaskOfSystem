<?php

namespace App\Http\Controllers;

use Symfony\Component\HttpFoundation\Response;

class CategoryController extends Controller
{
  public function index()
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
