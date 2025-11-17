<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ExampleTest extends TestCase
{
    use RefreshDatabase;

    /**
     * A basic test example.
     */
    public function test_the_application_returns_a_successful_response(): void
    {
        $this->seed(); // DatabaseSeeder を実行（courses/lessons が投入される）

        $response = $this->get('/');

        $response->assertStatus(200);
    }
}
