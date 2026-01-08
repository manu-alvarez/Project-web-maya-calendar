<?php

namespace Tests\Feature;

use App\Models\User;
use App\Models\UserProfile;
use App\Models\UserDailyKin;
use App\Models\UserOracleReading;
use App\Models\Kin;
use Database\Seeders\KinSeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class UserControllersTest extends TestCase
{
    use RefreshDatabase;

    protected User $user;
    protected string $token;

    protected function setUp(): void
    {
        parent::setUp();
        $this->seed(KinSeeder::class);
        $this->user = User::factory()->create();
        $this->token = $this->user->createToken('auth-token')->plainTextToken;
    }

    public function test_authenticated_user_can_get_profile()
    {
        $response = $this->withHeader('Authorization', 'Bearer ' . $this->token)
            ->getJson('/api/user/profile');

        $response->assertStatus(200)
            ->assertJsonStructure([
                'user' => [
                    'id',
                    'name',
                    'email',
                ],
                'profile',
            ]);

        $userData = $response->json('user');
        $this->assertEquals($this->user->id, $userData['id']);
        $this->assertEquals($this->user->name, $userData['name']);
        $this->assertEquals($this->user->email, $userData['email']);
    }

    public function test_authenticated_user_can_update_profile()
    {
        $updateData = [
            'name' => 'Updated Name',
            'email' => 'updated@example.com',
        ];

        $response = $this->withHeader('Authorization', 'Bearer ' . $this->token)
            ->putJson('/api/user/profile', $updateData);

        $response->assertStatus(200)
            ->assertJson([
                'id' => $this->user->id,
                'name' => 'Updated Name',
                'email' => 'updated@example.com',
            ]);

        $this->assertDatabaseHas('users', [
            'id' => $this->user->id,
            'name' => 'Updated Name',
            'email' => 'updated@example.com',
        ]);
    }

    public function test_authenticated_user_can_save_daily_kin()
    {
        $kin = Kin::first();

        $kinData = [
            'kin_id' => $kin->id,
            'notes' => 'Today is a great day',
            'mood' => 'happy',
        ];

        $response = $this->withHeader('Authorization', 'Bearer ' . $this->token)
            ->postJson('/api/user/save-kin', $kinData);

        $response->assertStatus(201)
            ->assertJsonStructure([
                'id',
                'user_id',
                'kin_id',
                'notes',
                'mood',
                'date',
            ]);

        $this->assertDatabaseHas('user_daily_kins', [
            'user_id' => $this->user->id,
            'kin_id' => $kin->id,
            'notes' => 'Today is a great day',
            'mood' => 'happy',
        ]);
    }

    public function test_authenticated_user_can_get_history()
    {
        $kin = Kin::first();
        UserDailyKin::factory()->create([
            'user_id' => $this->user->id,
            'kin_id' => $kin->id,
        ]);

        $response = $this->withHeader('Authorization', 'Bearer ' . $this->token)
            ->getJson('/api/user/history');

        $response->assertStatus(200)
            ->assertJsonStructure([
                'history' => [
                    '*' => [
                        'id',
                        'user_id',
                        'kin_id',
                        'date',
                        'notes',
                        'mood',
                        'created_at',
                        'updated_at',
                    ],
                ],
                'count',
            ]);

        $history = $response->json('history');
        $this->assertCount(1, $history);
    }

    public function test_authenticated_user_can_get_today_kin()
    {
        $response = $this->withHeader('Authorization', 'Bearer ' . $this->token)
            ->getJson('/api/user/kin-today');

        $response->assertStatus(200)
            ->assertJsonStructure([
                'date',
                'kin',
                'saved_kin',
            ]);
    }

    public function test_authenticated_user_can_save_reading()
    {
        $kin = Kin::first();

        $readingData = [
            'kin_id' => $kin->id,
            'interpretation' => 'This is my reading interpretation',
            'is_favorite' => false,
        ];

        $response = $this->withHeader('Authorization', 'Bearer ' . $this->token)
            ->postJson('/api/user/readings', $readingData);

        $response->assertStatus(200)
            ->assertJsonStructure([
                'message',
                'reading' => [
                    'id',
                    'user_id',
                    'kin_id',
                    'interpretation',
                    'is_favorite',
                ],
            ]);

        $this->assertDatabaseHas('user_oracle_readings', [
            'user_id' => $this->user->id,
            'kin_id' => $kin->id,
            'interpretation' => 'This is my reading interpretation',
        ]);
    }

    public function test_authenticated_user_can_get_readings()
    {
        $kin = Kin::first();
        UserOracleReading::factory()->create([
            'user_id' => $this->user->id,
            'kin_id' => $kin->id,
        ]);

        $response = $this->withHeader('Authorization', 'Bearer ' . $this->token)
            ->getJson('/api/user/readings');

        $response->assertStatus(200)
            ->assertJsonStructure([
                'readings' => [
                    '*' => [
                        'id',
                        'user_id',
                        'kin_id',
                        'interpretation',
                        'is_favorite',
                    ],
                ],
                'count',
            ]);

        $this->assertCount(1, $response->json('readings'));
    }

    public function test_authenticated_user_can_get_reading_by_id()
    {
        $kin = Kin::first();
        $reading = UserOracleReading::factory()->create([
            'user_id' => $this->user->id,
            'kin_id' => $kin->id,
        ]);

        $response = $this->withHeader('Authorization', 'Bearer ' . $this->token)
            ->getJson("/api/user/readings/{$reading->id}");

        $response->assertStatus(200)
            ->assertJsonStructure([
                'reading' => [
                    'id',
                    'user_id',
                    'kin_id',
                    'interpretation',
                    'is_favorite',
                ],
            ]);

        $readingData = $response->json('reading');
        $this->assertEquals($reading->id, $readingData['id']);
        $this->assertEquals($this->user->id, $readingData['user_id']);
        $this->assertEquals($kin->id, $readingData['kin_id']);
    }

    public function test_authenticated_user_can_update_reading()
    {
        $kin = Kin::first();
        $reading = UserOracleReading::factory()->create([
            'user_id' => $this->user->id,
            'kin_id' => $kin->id,
            'interpretation' => 'Original interpretation',
            'is_favorite' => false,
        ]);

        $updateData = [
            'interpretation' => 'Updated interpretation',
            'is_favorite' => true,
        ];

        $response = $this->withHeader('Authorization', 'Bearer ' . $this->token)
            ->putJson("/api/user/readings/{$reading->id}", $updateData);

        $response->assertStatus(200)
            ->assertJson([
                'message' => 'Reading updated successfully',
            ]);

        $readingData = $response->json('reading');
        $this->assertEquals($reading->id, $readingData['id']);
        $this->assertEquals('Updated interpretation', $readingData['interpretation']);
        $this->assertTrue($readingData['is_favorite']);
    }

    public function test_authenticated_user_can_delete_reading()
    {
        $kin = Kin::first();
        $reading = UserOracleReading::factory()->create([
            'user_id' => $this->user->id,
            'kin_id' => $kin->id,
        ]);

        $response = $this->withHeader('Authorization', 'Bearer ' . $this->token)
            ->deleteJson("/api/user/readings/{$reading->id}");

        $response->assertStatus(200)
            ->assertJson([
                'message' => 'Reading deleted successfully',
            ]);

        $this->assertDatabaseMissing('user_oracle_readings', [
            'id' => $reading->id,
        ]);
    }

    public function test_unauthenticated_user_cannot_access_protected_routes()
    {
        $response = $this->getJson('/api/user/profile');

        $response->assertStatus(401);
    }

    public function test_user_cannot_access_another_users_reading()
    {
        $otherUser = User::factory()->create();
        $otherToken = $otherUser->createToken('auth-token')->plainTextToken;

        $kin = Kin::first();
        $reading = UserOracleReading::factory()->create([
            'user_id' => $this->user->id,
            'kin_id' => $kin->id,
        ]);

        $response = $this->withHeader('Authorization', 'Bearer ' . $otherToken)
            ->deleteJson("/api/user/readings/{$reading->id}");

        $response->assertStatus(404);
    }

    public function test_user_cannot_delete_another_users_reading()
    {
        $otherUser = User::factory()->create();
        $otherToken = $otherUser->createToken('auth-token')->plainTextToken;

        $kin = Kin::first();
        $reading = UserOracleReading::factory()->create([
            'user_id' => $this->user->id,
            'kin_id' => $kin->id,
        ]);

        $response = $this->withHeader('Authorization', 'Bearer ' . $otherToken)
            ->deleteJson("/api/user/readings/{$reading->id}");

        $response->assertStatus(404);
        $this->assertDatabaseHas('user_oracle_readings', ['id' => $reading->id]);
    }
}
