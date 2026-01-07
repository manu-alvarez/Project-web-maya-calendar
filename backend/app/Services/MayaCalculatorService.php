<?php

namespace App\Services;

use App\Models\Kin;
use App\Models\Wavespell;
use App\Models\Castle;
use Carbon\Carbon;

class MayaCalculatorService
{
    protected $solarSeals = [
        1 => ['Dragon', 'Dragón', 'Red', 'Rojo'],
        2 => ['Wind', 'Viento', 'White', 'Blanco'],
        3 => ['Night', 'Noche', 'Blue', 'Azul'],
        4 => ['Seed', 'Semilla', 'Yellow', 'Amarillo'],
        5 => ['Serpent', 'Serpiente', 'Red', 'Rojo'],
        6 => ['World-Bridger', 'Puente del Mundo', 'White', 'Blanco'],
        7 => ['Hand', 'Mano', 'Blue', 'Azul'],
        8 => ['Star', 'Estrella', 'Yellow', 'Amarillo'],
        9 => ['Moon', 'Luna', 'Red', 'Rojo'],
        10 => ['Dog', 'Perro', 'White', 'Blanco'],
        11 => ['Monkey', 'Mono', 'Blue', 'Azul'],
        12 => ['Human', 'Humano', 'Yellow', 'Amarillo'],
        13 => ['Skywalker', 'Caminante del Cielo', 'Red', 'Rojo'],
        14 => ['Wizard', 'Mago', 'White', 'Blanco'],
        15 => ['Eagle', 'Águila', 'Blue', 'Azul'],
        16 => ['Warrior', 'Guerrero', 'Yellow', 'Amarillo'],
        17 => ['Earth', 'Tierra', 'Red', 'Rojo'],
        18 => ['Mirror', 'Espejo', 'White', 'Blanco'],
        19 => ['Storm', 'Tormenta', 'Blue', 'Azul'],
        20 => ['Sun', 'Sol', 'Yellow', 'Amarillo'],
    ];

    protected $galacticTones = [
        1 => ['Magnetic', 'Magnético'],
        2 => ['Lunar', 'Lunar'],
        3 => ['Electric', 'Eléctrico'],
        4 => ['Self-Existing', 'Autoexistente'],
        5 => ['Overtone', 'Armónico'],
        6 => ['Rhythmic', 'Rítmico'],
        7 => ['Resonant', 'Resonante'],
        8 => ['Galactic', 'Galáctico'],
        9 => ['Solar', 'Solar'],
        10 => ['Planetary', 'Planetario'],
        11 => ['Spectral', 'Espectral'],
        12 => ['Crystal', 'Cristal'],
        13 => ['Cosmic', 'Cósmico'],
    ];

    protected $gapDays = [
        4, 12, 19, 27, 30, 35, 42, 44, 51, 59, 66, 68, 73, 80, 88, 95, 102,
        109, 116, 123, 130, 138, 145, 152, 159, 167, 174, 181, 188, 195, 203, 210,
        218, 225, 232, 239, 246, 253, 260
    ];

    protected $coreDays = [7, 20, 33, 46, 59, 72, 85, 98, 111, 124, 137, 150, 163, 176, 189, 202, 215, 228, 241, 254];

    protected $referenceDate = '1987-07-26';

    public function calculateKinFromDate(string $date): int
    {
        $carbonDate = Carbon::parse($date);
        $reference = Carbon::parse($this->referenceDate);

        $daysPassed = $reference->diffInDays($carbonDate);
        $isLeapDay = $this->isLeapDay($carbonDate);

        if ($isLeapDay) {
            return 0;
        }

        $kin = ($daysPassed % 260) + 1;

        return $kin;
    }

    public function isLeapDay(Carbon $date): bool
    {
        return $date->month == 2 && $date->day == 29;
    }

    public function calculateWavespellId(int $kinNumber): int
    {
        return (int)ceil($kinNumber / 13);
    }

    public function calculateCastleId(int $kinNumber): int
    {
        $wavespellId = $this->calculateWavespellId($kinNumber);
        return (int)ceil($wavespellId / 4);
    }

    public function isGapDay(int $kinNumber): bool
    {
        return in_array($kinNumber, $this->gapDays);
    }

    public function isCoreDay(int $kinNumber): bool
    {
        return in_array($kinNumber, $this->coreDays);
    }

    public function getSolarSeal(int $kinNumber): array
    {
        $sealIndex = ($kinNumber - 1) % 20 + 1;
        return $this->solarSeals[$sealIndex];
    }

    public function getGalacticTone(int $kinNumber): array
    {
        $toneIndex = (($kinNumber - 1) % 13) + 1;
        return $this->galacticTones[$toneIndex];
    }

    public function getOracle(int $kinNumber): array
    {
        $destiny = $kinNumber;
        $guide = $this->calculateGuideKin($kinNumber);
        $analog = $this->calculateAnalogKin($kinNumber);
        $antipode = $this->calculateAntipodeKin($kinNumber);
        $occult = $this->calculateOccultKin($kinNumber);

        return [
            'destiny' => $destiny,
            'guide' => $guide,
            'analog' => $analog,
            'antipode' => $antipode,
            'occult' => $occult,
        ];
    }

    protected function calculateGuideKin(int $kinNumber): int
    {
        return ($kinNumber + 13) % 260 == 0 ? 260 : ($kinNumber + 13) % 260;
    }

    protected function calculateAnalogKin(int $kinNumber): int
    {
        $sealIndex = ($kinNumber - 1) % 20 + 1;
        $analogSealIndex = 21 - $sealIndex;

        $currentTone = $this->getGalacticTone($kinNumber);
        $analogKinNumber = ($analogSealIndex - 1) * 13 + (($kinNumber - 1) % 13) + 1;

        return $analogKinNumber > 0 ? $analogKinNumber : 260;
    }

    protected function calculateAntipodeKin(int $kinNumber): int
    {
        return ($kinNumber + 130) % 260 == 0 ? 260 : ($kinNumber + 130) % 260;
    }

    protected function calculateOccultKin(int $kinNumber): int
    {
        return ($kinNumber + 19) % 260 == 0 ? 260 : ($kinNumber + 19) % 260;
    }

    public function getKinData(int $kinNumber): ?array
    {
        $kin = Kin::byKinNumber($kinNumber)->first();

        if (!$kin) {
            return null;
        }

        $seal = $this->getSolarSeal($kinNumber);
        $tone = $this->getGalacticTone($kinNumber);
        $oracle = $this->getOracle($kinNumber);

        return [
            'kin' => $kin,
            'solar_seal' => $seal,
            'galactic_tone' => $tone,
            'oracle' => $oracle,
            'is_gap' => $this->isGapDay($kinNumber),
            'is_core_day' => $this->isCoreDay($kinNumber),
            'wavespell_id' => $this->calculateWavespellId($kinNumber),
            'castle_id' => $this->calculateCastleId($kinNumber),
        ];
    }

    public function getWavespellData(int $wavespellId): ?array
    {
        $wavespell = Wavespell::byWavespellNumber($wavespellId)->first();

        if (!$wavespell) {
            return null;
        }

        return [
            'wavespell' => $wavespell,
            'kins' => Kin::byWavespell($wavespellId)->get(),
        ];
    }

    public function getCastleData(int $castleId): ?array
    {
        $castle = Castle::byCastleNumber($castleId)->first();

        if (!$castle) {
            return null;
        }

        return [
            'castle' => $castle,
            'kins' => Kin::byCastle($castleId)->get(),
        ];
    }
}
