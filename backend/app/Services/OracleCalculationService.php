<?php

namespace App\Services;

class OracleCalculationService
{
    public function calculateOracle(int $kinNumber): array
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

        $currentTone = (($kinNumber - 1) % 13) + 1;
        $analogKinNumber = ($analogSealIndex - 1) * 13 + $currentTone;

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

    public function getOracleInterpretation(array $oracle): array
    {
        return [
            'destiny' => [
                'position' => 'Center',
                'meaning' => 'Your central energy, your core essence',
                'meaning_es' => 'Tu energía central, tu esencia fundamental',
            ],
            'guide' => [
                'position' => 'Above',
                'meaning' => 'Energy that guides and supports you',
                'meaning_es' => 'Energía que guía y te apoya',
            ],
            'analog' => [
                'position' => 'Right',
                'meaning' => 'Your supportive energy, like-minded energy',
                'meaning_es' => 'Tu energía de apoyo, energía afín',
            ],
            'antipode' => [
                'position' => 'Left',
                'meaning' => 'Your challenge energy, the polarity to transcend',
                'meaning_es' => 'Tu energía de desafío, la polaridad a trascender',
            ],
            'occult' => [
                'position' => 'Below',
                'meaning' => 'Your hidden power, unexpected gifts',
                'meaning_es' => 'Tu poder oculto, dones inesperados',
            ],
        ];
    }
}
