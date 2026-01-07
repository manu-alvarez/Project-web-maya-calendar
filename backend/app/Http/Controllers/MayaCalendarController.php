<?php

namespace App\Http\Controllers;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use App\Services\MayaCalculatorService;
use App\Services\DateConversionService;

class MayaCalendarController extends Controller
{
    protected $mayaCalculator;
    protected $dateConverter;

    public function __construct(MayaCalculatorService $mayaCalculator, DateConversionService $dateConverter)
    {
        $this->mayaCalculator = $mayaCalculator;
        $this->dateConverter = $dateConverter;
    }

    public function today(): JsonResponse
    {
        $today = now()->format('Y-m-d');
        $kinNumber = $this->mayaCalculator->calculateKinFromDate($today);

        $kinData = $this->mayaCalculator->getKinData($kinNumber);

        if (!$kinData) {
            return response()->json([
                'error' => 'Kin not found',
                'message' => 'Unable to calculate kin for today',
            ], 404);
        }

        $oracle = $this->mayaCalculator->getOracle($kinNumber);
        $kinData['oracle'] = $oracle;

        return response()->json([
            'date' => $today,
            'kin' => $kinData,
        ]);
    }

    public function date(string $date): JsonResponse
    {
        try {
            $parsedDate = \Carbon\Carbon::parse($date);
        } catch (\Exception $e) {
            return response()->json([
                'error' => 'Invalid date format',
                'message' => 'Please provide date in Y-m-d format',
            ], 400);
        }

        $kinNumber = $this->mayaCalculator->calculateKinFromDate($date);
        $kinData = $this->mayaCalculator->getKinData($kinNumber);

        if (!$kinData) {
            return response()->json([
                'error' => 'Kin not found',
                'message' => 'Unable to calculate kin for this date',
            ], 404);
        }

        $oracle = $this->mayaCalculator->getOracle($kinNumber);
        $kinData['oracle'] = $oracle;

        return response()->json([
            'date' => $date,
            'kin' => $kinData,
        ]);
    }

    public function getKinByNumber(int $kinId): JsonResponse
    {
        if ($kinId < 1 || $kinId > 260) {
            return response()->json([
                'error' => 'Invalid kin number',
                'message' => 'Kin number must be between 1 and 260',
            ], 400);
        }

        $kinData = $this->mayaCalculator->getKinData($kinId);

        if (!$kinData) {
            return response()->json([
                'error' => 'Kin not found',
                'message' => 'Kin not found in database',
            ], 404);
        }

        $oracle = $this->mayaCalculator->getOracle($kinId);
        $kinData['oracle'] = $oracle;

        return response()->json([
            'kin' => $kinData,
        ]);
    }

    public function getWavespellToday(): JsonResponse
    {
        $today = now()->format('Y-m-d');
        $kinNumber = $this->mayaCalculator->calculateKinFromDate($today);
        $wavespellId = $this->mayaCalculator->calculateWavespellId($kinNumber);

        $wavespellData = $this->mayaCalculator->getWavespellData($wavespellId);

        if (!$wavespellData) {
            return response()->json([
                'error' => 'Wavespell not found',
                'message' => 'Unable to calculate wavespell for today',
            ], 404);
        }

        return response()->json([
            'date' => $today,
            'wavespell' => $wavespellData,
        ]);
    }

    public function getWavespellByNumber(int $wavespellId): JsonResponse
    {
        if ($wavespellId < 1 || $wavespellId > 20) {
            return response()->json([
                'error' => 'Invalid wavespell number',
                'message' => 'Wavespell number must be between 1 and 20',
            ], 400);
        }

        $wavespellData = $this->mayaCalculator->getWavespellData($wavespellId);

        if (!$wavespellData) {
            return response()->json([
                'error' => 'Wavespell not found',
                'message' => 'Wavespell not found in database',
            ], 404);
        }

        return response()->json([
            'wavespell' => $wavespellData,
        ]);
    }

    public function getCastleToday(): JsonResponse
    {
        $today = now()->format('Y-m-d');
        $kinNumber = $this->mayaCalculator->calculateKinFromDate($today);
        $castleId = $this->mayaCalculator->calculateCastleId($kinNumber);

        $castleData = $this->mayaCalculator->getCastleData($castleId);

        if (!$castleData) {
            return response()->json([
                'error' => 'Castle not found',
                'message' => 'Unable to calculate castle for today',
            ], 404);
        }

        return response()->json([
            'date' => $today,
            'castle' => $castleData,
        ]);
    }

    public function getCastleByNumber(int $castleId): JsonResponse
    {
        if ($castleId < 1 || $castleId > 5) {
            return response()->json([
                'error' => 'Invalid castle number',
                'message' => 'Castle number must be between 1 and 5',
            ], 400);
        }

        $castleData = $this->mayaCalculator->getCastleData($castleId);

        if (!$castleData) {
            return response()->json([
                'error' => 'Castle not found',
                'message' => 'Castle not found in database',
            ], 404);
        }

        return response()->json([
            'castle' => $castleData,
        ]);
    }

    public function getOracleByKin(int $kinId): JsonResponse
    {
        if ($kinId < 1 || $kinId > 260) {
            return response()->json([
                'error' => 'Invalid kin number',
                'message' => 'Kin number must be between 1 and 260',
            ], 400);
        }

        $oracle = $this->mayaCalculator->getOracle($kinId);

        return response()->json([
            'kin_id' => $kinId,
            'oracle' => $oracle,
        ]);
    }
}
