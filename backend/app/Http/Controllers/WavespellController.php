<?php

namespace App\Http\Controllers;

use Illuminate\Http\JsonResponse;
use App\Models\Wavespell;
use App\Models\Kin;

class WavespellController extends Controller
{
    public function index(): JsonResponse
    {
        $wavespells = Wavespell::orderBy('wavespell_number')
            ->get();

        return response()->json([
            'wavespells' => $wavespells,
        ]);
    }

    public function show(int $wavespellId): JsonResponse
    {
        if ($wavespellId < 1 || $wavespellId > 20) {
            return response()->json([
                'error' => 'Invalid wavespell number',
                'message' => 'Wavespell number must be between 1 and 20',
            ], 400);
        }

        $wavespell = Wavespell::with('kins')
            ->where('wavespell_number', $wavespellId)
            ->first();

        if (!$wavespell) {
            return response()->json([
                'error' => 'Wavespell not found',
                'message' => 'Wavespell not found in database',
            ], 404);
        }

        return response()->json([
            'wavespell' => $wavespell,
        ]);
    }

    public function kins(int $wavespellId): JsonResponse
    {
        if ($wavespellId < 1 || $wavespellId > 20) {
            return response()->json([
                'error' => 'Invalid wavespell number',
                'message' => 'Wavespell number must be between 1 and 20',
            ], 400);
        }

        $kins = Kin::where('wavespell_id', $wavespellId)
            ->orderBy('kin_number')
            ->get();

        return response()->json([
            'wavespell_id' => $wavespellId,
            'kins' => $kins,
            'count' => $kins->count(),
        ]);
    }
}
