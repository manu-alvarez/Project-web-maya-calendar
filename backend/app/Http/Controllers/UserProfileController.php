<?php

namespace App\Http\Controllers;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use App\Models\UserProfile;
use App\Models\User;
use App\Services\MayaCalculatorService;

class UserProfileController extends Controller
{
    protected $mayaCalculator;

    public function __construct(MayaCalculatorService $mayaCalculator)
    {
        $this->mayaCalculator = $mayaCalculator;
    }

    public function getProfile(Request $request): JsonResponse
    {
        $user = auth()->user();
        $profile = $user->profile;

        if (!$profile) {
            $profile = UserProfile::create([
                'user_id' => $user->id,
            ]);
        }

        return response()->json([
            'user' => $user,
            'profile' => $profile,
        ]);
    }

    public function updateProfile(Request $request): JsonResponse
    {
        $request->validate([
            'birth_date' => 'nullable|date',
            'preferences' => 'nullable|array',
        ]);

        $user = auth()->user();
        $profile = $user->profile;

        if (!$profile) {
            $profile = UserProfile::create([
                'user_id' => $user->id,
            ]);
        }

        if ($request->has('birth_date')) {
            $birthDate = $request->input('birth_date');
            $birthKin = $this->mayaCalculator->calculateKinFromDate($birthDate);

            if ($birthKin > 0) {
                $kinData = $this->mayaCalculator->getKinData($birthKin);
                $oracle = $this->mayaCalculator->getOracle($birthKin);

                $profile->update([
                    'birth_kin' => $birthKin,
                    'tone_of_birth' => $kinData['kin']->galactic_tone,
                    'solar_seal_of_birth' => $kinData['kin']->solar_seal,
                    'color_of_birth' => $kinData['kin']->color,
                    'oracle_guide' => $oracle['guide'],
                    'oracle_analog' => $oracle['analog'],
                    'oracle_antipode' => $oracle['antipode'],
                    'oracle_occult' => $oracle['occult'],
                ]);
            }
        }

        if ($request->has('preferences')) {
            $currentPreferences = $profile->preferences ?? [];
            $newPreferences = array_merge($currentPreferences, $request->input('preferences'));
            $profile->preferences = $newPreferences;
        }

        $profile->save();

        return response()->json([
            'message' => 'Profile updated successfully',
            'profile' => $profile->load('birthKin'),
        ]);
    }
}
