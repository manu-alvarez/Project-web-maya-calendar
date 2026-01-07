<?php

namespace App\Http\Controllers;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use App\Models\UserDailyKin;
use App\Services\MayaCalculatorService;
use App\Models\Kin;
use Carbon\Carbon;

class UserCalendarController extends Controller
{
    protected $mayaCalculator;

    public function __construct(MayaCalculatorService $mayaCalculator)
    {
        $this->mayaCalculator = $mayaCalculator;
    }

    public function getTodayKin(Request $request): JsonResponse
    {
        $user = auth()->user();
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

        $userDailyKin = UserDailyKin::where('user_id', $user->id)
            ->where('date', $today)
            ->first();

        if (!$userDailyKin) {
            $userDailyKin = UserDailyKin::create([
                'user_id' => $user->id,
                'date' => $today,
                'kin_id' => $kinNumber,
                'wavespell_id' => $this->mayaCalculator->calculateWavespellId($kinNumber),
                'castle_id' => $this->mayaCalculator->calculateCastleId($kinNumber),
                'is_viewed' => true,
                'viewed_at' => now(),
                'oracle_data' => $oracle,
            ]);
        }

        return response()->json([
            'date' => $today,
            'kin' => $kinData,
            'user_daily_kin' => $userDailyKin,
        ]);
    }

    public function getHistory(Request $request): JsonResponse
    {
        $user = auth()->user();
        $limit = min($request->input('limit', 30), 100);
        $offset = $request->input('offset', 0);

        $history = UserDailyKin::where('user_id', $user->id)
            ->where('is_viewed', true)
            ->orderBy('date', 'desc')
            ->offset($offset)
            ->limit($limit)
            ->with(['kin', 'wavespell', 'castle'])
            ->get();

        return response()->json([
            'history' => $history,
            'count' => $history->count(),
        ]);
    }

    public function saveDailyKin(Request $request): JsonResponse
    {
        $request->validate([
            'date' => 'required|date',
            'notes' => 'nullable|string|max:1000',
        ]);

        $user = auth()->user();
        $date = $request->input('date');
        $kinNumber = $this->mayaCalculator->calculateKinFromDate($date);

        $userDailyKin = UserDailyKin::updateOrCreate(
            [
                'user_id' => $user->id,
                'date' => $date,
            ],
            [
                'kin_id' => $kinNumber,
                'wavespell_id' => $this->mayaCalculator->calculateWavespellId($kinNumber),
                'castle_id' => $this->mayaCalculator->calculateCastleId($kinNumber),
                'notes' => $request->input('notes'),
            ]
        );

        return response()->json([
            'message' => 'Daily kin saved successfully',
            'user_daily_kin' => $userDailyKin,
        ]);
    }
}
