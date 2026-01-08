<?php

namespace Tests\Feature;

use App\Models\Kin;
use App\Models\Wavespell;
use App\Models\Castle;
use Database\Seeders\KinSeeder;
use Database\Seeders\WavespellSeeder;
use Database\Seeders\CastleSeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class MayaCalendarControllerTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();
        $this->seed(CastleSeeder::class);
        $this->seed(WavespellSeeder::class);
        $this->seed(KinSeeder::class);
    }

    public function test_can_get_today_kin()
    {
        $response = $this->getJson('/api/calendar/today');

        $response->assertStatus(200)
            ->assertJsonStructure([
                'date',
                'kin' => [
                    'kin' => [
                        'id',
                        'kin_number',
                        'solar_seal',
                        'solar_seal_es',
                        'galactic_tone',
                        'galactic_tone_name',
                        'color',
                        'color_es',
                        'power',
                        'power_es',
                        'action',
                        'action_es',
                        'essence',
                        'essence_es',
                        'is_gap',
                        'is_core_day',
                        'wavespell_id',
                        'castle_id',
                    ],
                    'solar_seal',
                    'galactic_tone',
                    'oracle' => [
                        'destiny',
                        'guide',
                        'analog',
                        'antipode',
                        'occult',
                    ],
                    'is_gap',
                    'is_core_day',
                    'wavespell_id',
                    'castle_id',
                ],
            ]);
    }

    public function test_can_get_kin_by_date()
    {
        $response = $this->getJson('/api/calendar/date/2026-01-01');

        $response->assertStatus(200)
            ->assertJsonStructure([
                'date',
                'kin',
            ]);

        $this->assertEquals('2026-01-01', $response->json('date'));
    }

    public function test_can_get_kin_by_number()
    {
        $kin = Kin::first();

        $response = $this->getJson("/api/calendar/kin/{$kin->kin_number}");

        $response->assertStatus(200)
            ->assertJsonStructure([
                'kin' => [
                    'kin' => [
                        'id',
                        'kin_number',
                        'solar_seal',
                        'solar_seal_es',
                        'galactic_tone',
                        'galactic_tone_name',
                        'color',
                        'color_es',
                        'power',
                        'power_es',
                        'action',
                        'action_es',
                        'essence',
                        'essence_es',
                        'is_gap',
                        'is_core_day',
                        'wavespell_id',
                        'castle_id',
                    ],
                    'solar_seal',
                    'galactic_tone',
                    'oracle',
                    'is_gap',
                    'is_core_day',
                    'wavespell_id',
                    'castle_id',
                ],
            ]);

        $this->assertEquals($kin->kin_number, $response->json('kin.kin.kin_number'));
    }

    public function test_can_get_wavespell_today()
    {
        $response = $this->getJson('/api/calendar/wavespell/today');

        $response->assertStatus(200)
            ->assertJsonStructure([
                'wavespell' => [
                    'wavespell' => [
                        'id',
                        'wavespell_number',
                        'solar_seal',
                        'solar_seal_es',
                        'color',
                        'color_es',
                        'start_kin',
                        'end_kin',
                        'kin_count',
                        'description',
                        'description_es',
                    ],
                    'kins' => [
                        '*' => [
                            'id',
                            'kin_number',
                            'solar_seal',
                            'solar_seal_es',
                            'galactic_tone',
                            'galactic_tone_name',
                        ],
                    ],
                ],
            ]);
    }

    public function test_can_get_wavespell_by_number()
    {
        $wavespell = Wavespell::first();

        $response = $this->getJson("/api/calendar/wavespell/{$wavespell->wavespell_number}");

        $response->assertStatus(200)
            ->assertJsonStructure([
                'wavespell' => [
                    'wavespell',
                    'kins',
                ],
            ]);

        $this->assertEquals($wavespell->wavespell_number, $response->json('wavespell.wavespell.wavespell_number'));
    }

    public function test_can_get_castle_today()
    {
        $response = $this->getJson('/api/calendar/castle/today');

        $response->assertStatus(200)
            ->assertJsonStructure([
                'castle' => [
                    'castle' => [
                        'id',
                        'castle_number',
                        'name',
                        'name_es',
                        'color',
                        'color_es',
                        'start_kin',
                        'end_kin',
                        'kin_count',
                        'wavespell_count',
                        'description',
                        'description_es',
                    ],
                    'kins' => [
                        '*' => [
                            'id',
                            'kin_number',
                            'solar_seal',
                            'solar_seal_es',
                            'galactic_tone',
                            'galactic_tone_name',
                        ],
                    ],
                ],
            ]);
    }

    public function test_can_get_castle_by_number()
    {
        $castle = Castle::first();

        $response = $this->getJson("/api/calendar/castle/{$castle->castle_number}");

        $response->assertStatus(200)
            ->assertJsonStructure([
                'castle' => [
                    'castle',
                    'kins',
                ],
            ]);

        $this->assertEquals($castle->castle_number, $response->json('castle.castle.castle_number'));
    }

    public function test_can_get_oracle_by_kin()
    {
        $kinNumber = 1;

        $response = $this->getJson("/api/calendar/oracle/{$kinNumber}");

        $response->assertStatus(200)
            ->assertJsonStructure([
                'kin_number',
                'solar_seal',
                'galactic_tone',
                'oracle' => [
                    'destiny' => [
                        'id',
                        'kin_number',
                        'solar_seal',
                        'solar_seal_es',
                        'galactic_tone',
                        'galactic_tone_name',
                        'color',
                        'color_es',
                        'power',
                        'power_es',
                    ],
                    'guide' => [
                        'id',
                        'kin_number',
                        'solar_seal',
                        'solar_seal_es',
                        'galactic_tone',
                        'galactic_tone_name',
                        'color',
                        'color_es',
                        'power',
                        'power_es',
                    ],
                    'analog' => [
                        'id',
                        'kin_number',
                        'solar_seal',
                        'solar_seal_es',
                        'galactic_tone',
                        'galactic_tone_name',
                        'color',
                        'color_es',
                        'power',
                        'power_es',
                    ],
                    'antipode' => [
                        'id',
                        'kin_number',
                        'solar_seal',
                        'solar_seal_es',
                        'galactic_tone',
                        'galactic_tone_name',
                        'color',
                        'color_es',
                        'power',
                        'power_es',
                    ],
                    'occult' => [
                        'id',
                        'kin_number',
                        'solar_seal',
                        'solar_seal_es',
                        'galactic_tone',
                        'galactic_tone_name',
                        'color',
                        'color_es',
                        'power',
                        'power_es',
                    ],
                ],
            ]);

        $this->assertEquals($kinNumber, $response->json('kin_number'));
        $this->assertArrayHasKey('destiny', $response->json('oracle'));
        $this->assertArrayHasKey('guide', $response->json('oracle'));
        $this->assertArrayHasKey('analog', $response->json('oracle'));
        $this->assertArrayHasKey('antipode', $response->json('oracle'));
        $this->assertArrayHasKey('occult', $response->json('oracle'));
    }

    public function test_oracle_contains_all_five_energies()
    {
        $response = $this->getJson('/api/calendar/oracle/1');

        $oracle = $response->json('oracle');

        $this->assertNotEmpty($oracle['destiny']);
        $this->assertNotEmpty($oracle['guide']);
        $this->assertNotEmpty($oracle['analog']);
        $this->assertNotEmpty($oracle['antipode']);
        $this->assertNotEmpty($oracle['occult']);
    }

    public function test_can_get_gap_kins()
    {
        $response = $this->getJson('/api/kins/gaps');

        $response->assertStatus(200)
            ->assertJsonStructure([
                'gap_kins' => [
                    '*' => [
                        'id',
                        'kin_number',
                        'solar_seal',
                        'solar_seal_es',
                        'is_gap',
                    ],
                ],
                'count',
            ]);

        $gapKins = $response->json('gap_kins');
        $this->assertTrue(count($gapKins) > 0);
        $this->assertTrue(collect($gapKins)->every(fn($kin) => $kin['is_gap'] === true));
    }

    public function test_can_get_core_days()
    {
        $response = $this->getJson('/api/kins/core-days');

        $response->assertStatus(200)
            ->assertJsonStructure([
                'core_days' => [
                    '*' => [
                        'id',
                        'kin_number',
                        'solar_seal',
                        'solar_seal_es',
                        'is_core_day',
                    ],
                ],
                'count',
            ]);

        $coreDays = $response->json('core_days');
        $this->assertTrue(count($coreDays) > 0);
        $this->assertTrue(collect($coreDays)->every(fn($kin) => $kin['is_core_day'] === true));
    }

    public function test_wavespell_contains_13_kins()
    {
        $wavespell = Wavespell::first();
        $response = $this->getJson("/api/calendar/wavespell/{$wavespell->wavespell_number}");

        $kins = $response->json('wavespell.kins');
        $this->assertCount(13, $kins);
    }

    public function test_castle_contains_52_kins()
    {
        $castle = Castle::first();
        $response = $this->getJson("/api/calendar/castle/{$castle->castle_number}");

        $kins = $response->json('castle.kins');
        $this->assertCount(52, $kins);
    }
}
