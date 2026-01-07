<?php

namespace App\Services;

class WavespellCalculationService
{
    public function getWavespellForKin(int $kinNumber): int
    {
        return (int)ceil($kinNumber / 13);
    }

    public function getWavespellPosition(int $kinNumber, int $wavespellId): int
    {
        $wavespellStart = ($wavespellId - 1) * 13 + 1;
        return $kinNumber - $wavespellStart + 1;
    }

    public function getWavespellPurpose(int $position): string
    {
        $purposes = [
            1 => 'Unify',
            2 => 'Polarize',
            3 => 'Activate',
            4 => 'Define',
            5 => 'Empower',
            6 => 'Organize',
            7 => 'Channel',
            8 => 'Harmonize',
            9 => 'Pulse',
            10 => 'Perfect',
            11 => 'Dissolve',
            12 => 'Dedicate',
            13 => 'Transcend',
        ];

        return $purposes[$position] ?? '';
    }

    public function getWavespellPurposeEs(int $position): string
    {
        $purposes = [
            1 => 'Unificar',
            2 => 'Polarizar',
            3 => 'Activar',
            4 => 'Definir',
            5 => 'Potenciar',
            6 => 'Organizar',
            7 => 'Canalizar',
            8 => 'Armonizar',
            9 => 'Pulsar',
            10 => 'Perfeccionar',
            11 => 'Disolver',
            12 => 'Dedicar',
            13 => 'Transcender',
        ];

        return $purposes[$position] ?? '';
    }

    public function getWavespellColor(int $wavespellId): string
    {
        $colors = ['Red', 'White', 'Blue', 'Yellow'];
        return $colors[($wavespellId - 1) % 4];
    }

    public function getWavespellColorEs(int $wavespellId): string
    {
        $colors = ['Rojo', 'Blanco', 'Azul', 'Amarillo'];
        return $colors[($wavespellId - 1) % 4];
    }

    public function getWavespellDays(int $wavespellId): array
    {
        $start = ($wavespellId - 1) * 13 + 1;
        $end = $wavespellId * 13;

        $days = [];
        for ($i = $start; $i <= $end; $i++) {
            $days[] = $i;
        }

        return $days;
    }
}
