<?php

namespace App\Http\Controllers;

use Illuminate\Http\JsonResponse;
use App\Models\Kin;

class KinController extends Controller
{
    public function index(): JsonResponse
    {
        $kins = Kin::with(['wavespell', 'castle'])
            ->orderBy('kin_number')
            ->paginate(20);

        return response()->json([
            'kins' => $kins,
        ]);
    }

    public function show(int $kinId): JsonResponse
    {
        if ($kinId < 1 || $kinId > 260) {
            return response()->json([
                'error' => 'Invalid kin number',
                'message' => 'Kin number must be between 1 and 260',
            ], 400);
        }

        $kin = Kin::with(['wavespell', 'castle'])
            ->where('kin_number', $kinId)
            ->first();

        if (!$kin) {
            return response()->json([
                'error' => 'Kin not found',
                'message' => 'Kin not found in database',
            ], 404);
        }

        return response()->json([
            'kin' => $kin,
        ]);
    }

    public function searchBySeal(string $seal): JsonResponse
    {
        $kins = Kin::where('solar_seal', 'like', "%{$seal}%")
            ->orWhere('solar_seal_es', 'like', "%{$seal}%")
            ->orderBy('kin_number')
            ->get();

        return response()->json([
            'kins' => $kins,
            'count' => $kins->count(),
        ]);
    }

    public function searchByTone(int $tone): JsonResponse
    {
        if ($tone < 1 || $tone > 13) {
            return response()->json([
                'error' => 'Invalid tone number',
                'message' => 'Tone number must be between 1 and 13',
            ], 400);
        }

        $kins = Kin::where('galactic_tone', $tone)
            ->orderBy('kin_number')
            ->get();

        return response()->json([
            'kins' => $kins,
            'count' => $kins->count(),
        ]);
    }

    public function searchByColor(string $color): JsonResponse
    {
        $kins = Kin::where('color', 'like', "%{$color}%")
            ->orWhere('color_es', 'like', "%{$color}%")
            ->orderBy('kin_number')
            ->get();

        return response()->json([
            'kins' => $kins,
            'count' => $kins->count(),
        ]);
    }

    public function gaps(): JsonResponse
    {
        $kins = Kin::where('is_gap', true)
            ->orderBy('kin_number')
            ->get();

        return response()->json([
            'gap_kins' => $kins,
            'count' => $kins->count(),
        ]);
    }

    public function coreDays(): JsonResponse
    {
        $kins = Kin::where('is_core_day', true)
            ->orderBy('kin_number')
            ->get();

        return response()->json([
            'core_days' => $kins,
            'count' => $kins->count(),
        ]);
    }
}
