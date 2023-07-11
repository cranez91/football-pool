<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class StoreCountryTest extends TestCase
{
    use WithFaker;
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_example()
    {
        $response = $this->postJson('/api/countries', [
            'name' => $this->faker->country,
            'uuid' => $this->faker->uuid,
        ]);
 
        $response
            ->assertStatus(200)
            ->assertJsonStructure([
                'name',
                'uuid',
            ]);
    }
}
