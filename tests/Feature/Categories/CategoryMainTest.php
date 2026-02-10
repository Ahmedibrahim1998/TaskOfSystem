<?php

namespace Tests\Feature\Categories;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class CategoryMainTest extends TestCase
{
    // /**
    //  * A basic feature test example.
    //  */
    // public function test_example(): void
    // {
    //     // get post put delete --> deletejson postJson putJson getJson
    //     $response = $this->deleteJson('/delete');

    //     $response->assertStatus(200);
    // }

        public function test_example(): void
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

            $response = $this->get('category/index');
            $data = $response->json();
            // dd($data);
            $this->assertEquals($catgeories,$data);

            $response->assertStatus(200);
        }
}
