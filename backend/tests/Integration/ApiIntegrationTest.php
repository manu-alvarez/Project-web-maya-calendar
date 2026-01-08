<?php

namespace Tests\Integration;

use App\Models\User;
use App\Database\Seeders\KinSeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ApiIntegrationTest extends TestCase
{
    use RefreshDatabase;

    public function test_full_registration_flow()
    {
        $userData = [
            'name' => 'Integration Test User',
            'email' => 'integration@example.com',
            'password' => 'password123',
            'password_confirmation' => 'password123',
        ];

        $registerResponse = $this->postJson('/api/register', $userData);

        $registerResponse->assertStatus(201)
            ->assertJsonStructure(['user', 'token']);

        $token = $registerResponse->json('token');
        $user = $registerResponse->json('user');

        $meResponse = $this->withHeader('Authorization', 'Bearer ' . $token)
            ->getJson('/api/me');

        $meResponse->assertStatus(200)
            ->assertJson([
                'id' => $user['id'],
                'name' => 'Integration Test User',
                'email' => 'integration@example.com',
            ]);

        $logoutResponse = $this->withHeader('Authorization', 'Bearer ' . $token)
            ->postJson('/api/logout');

        $logoutResponse->assertStatus(200)
            ->assertJson([
                'message' => 'Sesión cerrada exitosamente',
            ]);

        $this->assertCount(0, User::find($user['id'])->tokens);
    }

    public function test_full_login_flow()
    {
        $user = User::factory()->create([
            'password' => bcrypt('password123'),
        ]);

        $loginResponse = $this->postJson('/api/login', [
            'email' => $user->email,
            'password' => 'password123',
        ]);

        $loginResponse->assertStatus(200)
            ->assertJsonStructure(['user', 'token']);

        $token = $loginResponse->json('token');

        $meResponse = $this->withHeader('Authorization', 'Bearer ' . $token)
            ->getJson('/api/me');

        $meResponse->assertStatus(200)
            ->assertJson([
                'id' => $user->id,
                'name' => $user->name,
                'email' => $user->email,
            ]);

        $logoutResponse = $this->withHeader('Authorization', 'Bearer ' . $token)
            ->postJson('/api/logout');

        $logoutResponse->assertStatus(200);
    }

    public function test_protected_route_requires_auth()
    {
        $unprotectedResponse = $this->getJson('/api/me');
        $unprotectedResponse->assertStatus(401);

        $user = User::factory()->create();
        $token = $user->createToken('auth-token')->plainTextToken;

        $protectedResponse = $this->withHeader('Authorization', 'Bearer ' . $token)
            ->getJson('/api/me');

        $protectedResponse->assertStatus(200);
    }

    public function test_token_expiry_handling()
    {
        $user = User::factory()->create();
        $token = $user->createToken('auth-token', ['expires_at' => now()->subDay()])->plainTextToken;

        $response = $this->withHeader('Authorization', 'Bearer ' . $token)
            ->getJson('/api/me');

        $response->assertStatus(200);

        $this->assertEquals($user->id, $response->json('id'));
    }



    public function test_multiple_sessions_for_same_user()
    {
        $user = User::factory()->create([
            'password' => bcrypt('password123'),
        ]);

        $token1Response = $this->postJson('/api/login', [
            'email' => $user->email,
            'password' => 'password123',
        ]);

        $token2Response = $this->postJson('/api/login', [
            'email' => $user->email,
            'password' => 'password123',
        ]);

        $token1Response->assertStatus(200);
        $token2Response->assertStatus(200);

        $this->assertCount(2, $user->tokens);
    }

    public function test_logout_only_removes_current_token()
    {
        $user = User::factory()->create([
            'password' => bcrypt('password123'),
        ]);

        $token1Response = $this->postJson('/api/login', [
            'email' => $user->email,
            'password' => 'password123',
        ]);

        $token2Response = $this->postJson('/api/login', [
            'email' => $user->email,
            'password' => 'password123',
        ]);

        $token1 = $token1Response->json('token');
        $token2 = $token2Response->json('token');

        $logoutResponse = $this->withHeader('Authorization', 'Bearer ' . $token1)
            ->postJson('/api/logout');

        $logoutResponse->assertStatus(200);

        $user->refresh();
        $this->assertCount(1, $user->tokens);
    }

    public function test_api_response_format_is_consistent()
    {
        $response = $this->getJson('/api/calendar/today');

        $response->assertStatus(200);
        $response->assertHeader('content-type', 'application/json');

        $this->assertIsArray($response->json());
        $this->assertArrayHasKey('date', $response->json());
        $this->assertArrayHasKey('kin', $response->json());
        $this->assertIsArray($response->json('kin'));
    }

    public function test_error_responses_include_proper_status_codes()
    {
        $response = $this->postJson('/api/register', [
            'name' => 'Test',
            'email' => 'invalid-email',
            'password' => 'short',
        ]);

        $response->assertStatus(422);
        $response->assertJsonValidationErrors(['email', 'password']);
    }

    public function test_user_registration_creates_profile()
    {
        $userData = [
            'name' => 'Profile Test User',
            'email' => 'profile@example.com',
            'password' => 'password123',
            'password_confirmation' => 'password123',
        ];

        $this->postJson('/api/register', $userData);

        $user = User::where('email', 'profile@example.com')->first();
        $this->assertNotNull($user);
        $this->assertEquals('Profile Test User', $user->name);
    }
}
