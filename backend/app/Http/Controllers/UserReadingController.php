<?php

namespace App\Http\Controllers;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use App\Models\UserOracleReading;
use App\Services\MayaCalculatorService;

class UserReadingController extends Controller
{
    protected $mayaCalculator;

    public function __construct(MayaCalculatorService $mayaCalculator)
    {
        $this->mayaCalculator = $mayaCalculator;
    }

    public function saveReading(Request $request): JsonResponse
    {
        $request->validate([
            'kin_id' => 'required|integer|min:1|max:260',
            'interpretation' => 'nullable|string|max:5000',
            'is_favorite' => 'nullable|boolean',
        ]);

        $user = auth()->user();
        $kinId = $request->input('kin_id');
        $oracle = $this->mayaCalculator->getOracle($kinId);

        $reading = UserOracleReading::create([
            'user_id' => $user->id,
            'kin_id' => $kinId,
            'oracle_data' => $oracle,
            'interpretation' => $request->input('interpretation'),
            'is_favorite' => $request->input('is_favorite', false),
        ]);

        return response()->json([
            'message' => 'Oracle reading saved successfully',
            'reading' => $reading,
        ]);
    }

    public function getReadings(Request $request): JsonResponse
    {
        $user = auth()->user();
        $limit = min($request->input('limit', 30), 100);
        $offset = $request->input('offset', 0);
        $favoriteOnly = $request->input('favorites_only', false);

        $query = UserOracleReading::where('user_id', $user->id);

        if ($favoriteOnly) {
            $query->where('is_favorite', true);
        }

        $readings = $query->with('kin')
            ->orderBy('created_at', 'desc')
            ->offset($offset)
            ->limit($limit)
            ->get();

        return response()->json([
            'readings' => $readings,
            'count' => $readings->count(),
        ]);
    }

    public function getReading(int $readingId): JsonResponse
    {
        $user = auth()->user();
        $reading = UserOracleReading::where('user_id', $user->id)
            ->where('id', $readingId)
            ->with('kin')
            ->first();

        if (!$reading) {
            return response()->json([
                'error' => 'Reading not found',
                'message' => 'Reading not found or does not belong to user',
            ], 404);
        }

        return response()->json([
            'reading' => $reading,
        ]);
    }

    public function updateReading(Request $request, int $readingId): JsonResponse
    {
        $request->validate([
            'interpretation' => 'nullable|string|max:5000',
            'is_favorite' => 'nullable|boolean',
        ]);

        $user = auth()->user();
        $reading = UserOracleReading::where('user_id', $user->id)
            ->where('id', $readingId)
            ->first();

        if (!$reading) {
            return response()->json([
                'error' => 'Reading not found',
                'message' => 'Reading not found or does not belong to user',
            ], 404);
        }

        if ($request->has('interpretation')) {
            $reading->interpretation = $request->input('interpretation');
        }

        if ($request->has('is_favorite')) {
            $reading->is_favorite = $request->input('is_favorite');
        }

        $reading->save();

        return response()->json([
            'message' => 'Reading updated successfully',
            'reading' => $reading->load('kin'),
        ]);
    }

    public function deleteReading(int $readingId): JsonResponse
    {
        $user = auth()->user();
        $reading = UserOracleReading::where('user_id', $user->id)
            ->where('id', $readingId)
            ->first();

        if (!$reading) {
            return response()->json([
                'error' => 'Reading not found',
                'message' => 'Reading not found or does not belong to user',
            ], 404);
        }

        $reading->delete();

        return response()->json([
            'message' => 'Reading deleted successfully',
        ]);
    }
}
