<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ServiceTest extends TestCase
{
    /**
     * A basic feature test example.
     */
    public function test_index(): void
    {
        $response = $this->get('/services');

        $response->assertStatus(200);
    }

    public function test_insert(): void
    {
        $dates = json_encode(["2023-05-01T21:01:00.000Z","2023-05-02T21:01:00.000Z"]);
        $response = $this->postJson('/api/data',
            [
                'service_id' => '1',
                'max' => '1',
                'dates' => $dates
            ]
        );
        $response
            ->assertStatus(200)
            ->assertJson([
                'success' => true,
            ]);
    }
}
