<?php

namespace App\Http\Controllers;

use Illuminate\Http\JsonResponse;
use App\Models\Castle;
use App\Models\Kin;

class CastleController extends Controller
{
    public function index(): JsonResponse
    {
        $castles = Castle::orderBy('castle_number')
            ->get();

        return response()->json([
            'castles' => $castles,
        ]);
    }

    public function show(int $castleId): JsonResponse
    {
        if ($castleId < 1 || $castleId > 5) {
            return response()->json([
                'error' => 'Invalid castle number',
                'message' => 'Castle number must be between 1 and 5',
            ], 400);
        }

        $castle = Castle::with('kins')
            ->where('castle_number', $castleId)
            ->first();

        if (!$castle) {
            return response()->json([
                'error' => 'Castle not found',
                'message' => 'Castle not found in database',
            ], 404);
        }

        return response()->json([
            'castle' => $castle,
        ]);
    }

    public function kins(int $castleId): JsonResponse
    {
        if ($castleId < 1 || $castleId > 5) {
            return response()->json([
                'error' => 'Invalid castle number',
                'message' => 'Castle number must be between 1 and 5',
            ], 400);
        }

        $kins = Kin::where('castle_id', $castleId)
            ->orderBy('kin_number')
            ->get();

        return response()->json([
            'castle_id' => $castleId,
            'kins' => $kins,
            'count' => $kins->count(),
        ]);
    }
}
