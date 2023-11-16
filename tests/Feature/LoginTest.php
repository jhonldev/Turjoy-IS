<?php

namespace Tests\Feature;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class LoginTest extends TestCase
{
    public function loginComplete(): void
    {
        $response = $this->get('/login');

        $response->assertStatus(200);
    }

    public function testLogin()
{
    /** @var \App\Models\User $user */
    $user = \App\Models\User::factory()->create([
        'email' => 'test@example.com',
        'password' => bcrypt('password'),
    ]);

    $response = $this->actingAs($user)->get('/add/route');

    $response->assertStatus(200);
}
}
