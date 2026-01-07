<?php

namespace App\Services;

use Carbon\Carbon;

class DateConversionService
{
    protected $referenceDate = '1987-07-26';

    public function dateToKin(string $date): int
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

    public function getDayOutOfYear(string $date): string
    {
        $carbonDate = Carbon::parse($date);
        
        if ($this->isLeapDay($carbonDate)) {
            return 'Day Out of Time';
        }

        $dayOfYear = $carbonDate->dayOfYear;
        $kin = $this->dateToKin($date);

        $wavespellId = (int)ceil($kin / 13);
        $castleId = (int)ceil($wavespellId / 4);

        $mayaDate = sprintf('Moon %d, Day %d of Wavespell %d, Castle %d',
            (int)ceil($dayOfYear / 28),
            (($dayOfYear - 1) % 28) + 1,
            $wavespellId,
            $castleId
        );

        return $mayaDate;
    }

    public function getYearProgress(string $date): array
    {
        $carbonDate = Carbon::parse($date);
        $dayOfYear = $carbonDate->dayOfYear;
        $totalDays = $carbonDate->isLeapYear() ? 366 : 365;

        return [
            'day_of_year' => $dayOfYear,
            'total_days' => $totalDays,
            'percentage' => round(($dayOfYear / $totalDays) * 100, 2),
            'days_remaining' => $totalDays - $dayOfYear,
        ];
    }

    public function getWavespellForDate(string $date): int
    {
        $kin = $this->dateToKin($date);
        return (int)ceil($kin / 13);
    }

    public function getCastleForDate(string $date): int
    {
        $kin = $this->dateToKin($date);
        $wavespellId = (int)ceil($kin / 13);
        return (int)ceil($wavespellId / 4);
    }
}
