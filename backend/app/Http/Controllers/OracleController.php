<?php

namespace App\Http\Controllers;

use Illuminate\Http\JsonResponse;
use App\Services\OracleCalculationService;

class OracleController extends Controller
{
    protected $oracleCalculator;

    public function __construct(OracleCalculationService $oracleCalculator)
    {
        $this->oracleCalculator = $oracleCalculator;
    }

    public function getOracle(int $kinId): JsonResponse
    {
        if ($kinId < 1 || $kinId > 260) {
            return response()->json([
                'error' => 'Invalid kin number',
                'message' => 'Kin number must be between 1 and 260',
            ], 400);
        }

        $oracle = $this->oracleCalculator->calculateOracle($kinId);
        $interpretation = $this->oracleCalculator->getOracleInterpretation($oracle);

        return response()->json([
            'kin_id' => $kinId,
            'oracle' => $oracle,
            'interpretation' => $interpretation,
        ]);
    }

    public function getInterpretation(int $kinId): JsonResponse
    {
        if ($kinId < 1 || $kinId > 260) {
            return response()->json([
                'error' => 'Invalid kin number',
                'message' => 'Kin number must be between 1 and 260',
            ], 400);
        }

        $oracle = $this->oracleCalculator->calculateOracle($kinId);
        $interpretation = $this->oracleCalculator->getOracleInterpretation($oracle);

        return response()->json([
            'kin_id' => $kinId,
            'interpretation' => $interpretation,
        ]);
    }
}
