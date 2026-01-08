<?php

namespace Tests\Integration;

use App\Models\Kin;
use App\Models\Wavespell;
use App\Models\Castle;
use Database\Seeders\CastleSeeder;
use Database\Seeders\WavespellSeeder;
use Database\Seeders\KinSeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class DatabaseIntegrationTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();
        $this->seed(CastleSeeder::class);
        $this->seed(WavespellSeeder::class);
        $this->seed(KinSeeder::class);
    }

    public function test_seeders_populate_database_correctly()
    {
        $this->assertDatabaseCount('castles', 5);
        $this->assertDatabaseCount('wavespells', 20);
        $this->assertDatabaseCount('kins', 260);
    }

    public function test_castles_have_correct_ordering()
    {
        $castles = Castle::orderBy('castle_number')->get();

        $this->assertEquals('Red Castle', $castles[0]->name);
        $this->assertEquals('White Castle', $castles[1]->name);
        $this->assertEquals('Blue Castle', $castles[2]->name);
        $this->assertEquals('Yellow Castle', $castles[3]->name);
        $this->assertEquals('Green Castle', $castles[4]->name);
    }

    public function test_wavespells_have_correct_kin_count()
    {
        $wavespells = Wavespell::all();

        foreach ($wavespells as $wavespell) {
            $this->assertEquals(13, $wavespell->kin_count, "Wavespell {$wavespell->wavespell_number} should have 13 kins");
        }
    }

    public function test_castles_have_correct_wavespell_count()
    {
        $castles = Castle::all();

        foreach ($castles as $castle) {
            $this->assertEquals(4, $castle->wavespell_count, "Castle {$castle->castle_number} should have 4 wavespells");
        }
    }

    public function test_castles_have_correct_kin_count()
    {
        $castles = Castle::all();

        foreach ($castles as $castle) {
            $this->assertEquals(52, $castle->kin_count, "Castle {$castle->castle_number} should have 52 kins");
        }
    }

    public function test_kins_relationships_work()
    {
        $kin = Kin::first();

        $this->assertInstanceOf(Wavespell::class, $kin->wavespell);
        $this->assertInstanceOf(Castle::class, $kin->castle);
    }

    public function test_kins_are_distributed_correctly_across_wavespells()
    {
        $wavespells = Wavespell::all();

        foreach ($wavespells as $wavespell) {
            $kins = Kin::where('wavespell_id', $wavespell->id)->get();
            $this->assertCount(13, $kins, "Wavespell {$wavespell->wavespell_number} should have exactly 13 kins");
        }
    }

    public function test_kins_are_distributed_correctly_across_castles()
    {
        $castles = Castle::all();

        foreach ($castles as $castle) {
            $kins = Kin::where('castle_id', $castle->id)->get();
            $this->assertCount(52, $kins, "Castle {$castle->castle_number} should have exactly 52 kins");
        }
    }

    public function test_gap_kins_are_correctly_identified()
    {
        $gapDays = [4, 12, 19, 27, 30, 35, 42, 44, 51, 59, 66, 68, 73, 80, 88, 95, 102, 109, 116, 123, 130, 138, 145, 152, 159, 167, 174, 181, 188, 195, 203, 210, 218, 225, 232, 239, 246, 253, 260];

        foreach ($gapDays as $kinNumber) {
            $kin = Kin::where('kin_number', $kinNumber)->first();
            $this->assertTrue($kin->is_gap, "Kin {$kinNumber} should be marked as GAP");
        }
    }

    public function test_core_days_are_correctly_identified()
    {
        $coreDays = [7, 20, 33, 46, 59, 72, 85, 98, 111, 124, 137, 150, 163, 176, 189, 202, 215, 228, 241, 254];

        foreach ($coreDays as $kinNumber) {
            $kin = Kin::where('kin_number', $kinNumber)->first();
            $this->assertTrue($kin->is_core_day, "Kin {$kinNumber} should be marked as Core Day");
        }
    }

    public function test_all_kins_have_unique_kin_numbers()
    {
        $kinNumbers = Kin::pluck('kin_number')->toArray();
        $uniqueKinNumbers = array_unique($kinNumbers);

        $this->assertEquals(count($kinNumbers), count($uniqueKinNumbers), 'All kin numbers should be unique');
    }

    public function test_kin_numbers_are_sequential()
    {
        $kins = Kin::orderBy('kin_number')->pluck('kin_number')->toArray();

        for ($i = 0; $i < count($kins); $i++) {
            $expectedNumber = $i + 1;
            $this->assertEquals($expectedNumber, $kins[$i], "Kin at position {$i} should have number {$expectedNumber}");
        }
    }

    public function test_solar_seals_repeat_in_correct_order()
    {
        $solarSeals = ['Dragon', 'Wind', 'Night', 'Seed', 'Serpent', 'World-Bridger', 'Hand', 'Star', 'Moon', 'Dog', 'Monkey', 'Human', 'Skywalker', 'Wizard', 'Eagle', 'Warrior', 'Earth', 'Mirror', 'Storm', 'Sun'];

        $kins = Kin::take(20)->pluck('solar_seal')->toArray();

        $this->assertEquals($solarSeals, $kins, 'Solar seals should repeat in correct order every 20 kins');
    }

    public function test_galactic_tones_repeat_in_correct_order()
    {
        $galacticTones = ['Magnetic', 'Lunar', 'Electric', 'Self-Existing', 'Overtone', 'Rhythmic', 'Resonant', 'Galactic', 'Solar', 'Planetary', 'Spectral', 'Crystal', 'Cosmic'];

        $kins = Kin::take(13)->pluck('galactic_tone_name')->toArray();

        $this->assertEquals($galacticTones, $kins, 'Galactic tones should repeat in correct order every 13 kins');
    }

    public function test_wavespells_have_correct_color_sequence()
    {
        $colorSequence = ['Red', 'White', 'Blue', 'Yellow', 'Red', 'White', 'Blue', 'Yellow', 'Red', 'White', 'Blue', 'Yellow', 'Red', 'White', 'Blue', 'Yellow', 'Red', 'White', 'Blue', 'Yellow'];

        $wavespells = Wavespell::take(20)->pluck('color')->toArray();

        $this->assertEquals($colorSequence, $wavespells, 'Wavespells should follow the correct color sequence');
    }

    public function test_castles_have_correct_color_sequence()
    {
        $colorSequence = ['Red', 'White', 'Blue', 'Yellow', 'Green'];

        $castles = Castle::pluck('color')->toArray();

        $this->assertEquals($colorSequence, $castles, 'Castles should follow the correct color sequence');
    }

    public function test_first_kin_has_correct_values()
    {
        $kin = Kin::where('kin_number', 1)->first();

        $this->assertEquals('Dragon', $kin->solar_seal);
        $this->assertEquals('Magnetic', $kin->galactic_tone_name);
        $this->assertEquals('Red', $kin->color);
        $this->assertEquals(1, $kin->wavespell_id);
        $this->assertEquals(1, $kin->castle_id);
        $this->assertFalse($kin->is_gap);
        $this->assertFalse($kin->is_core_day);
    }

    public function test_last_kin_has_correct_values()
    {
        $kin = Kin::where('kin_number', 260)->first();

        $this->assertEquals('Sun', $kin->solar_seal);
        $this->assertEquals('Cosmic', $kin->galactic_tone_name);
        $this->assertEquals('Yellow', $kin->color);
        $this->assertEquals(20, $kin->wavespell_id);
        $this->assertEquals(5, $kin->castle_id);
        $this->assertTrue($kin->is_gap);
        $this->assertFalse($kin->is_core_day);
    }
}
