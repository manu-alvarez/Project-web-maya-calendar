<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class GoogleController extends Controller
{
    public function redirect()
    {
        return response()->json([
            'url' => 'https://accounts.google.com/o/oauth2/v2/auth?' . http_build_query([
                'client_id' => env('GOOGLE_CLIENT_ID'),
                'redirect_uri' => env('GOOGLE_REDIRECT_URI'),
                'scope' => 'openid profile email',
                'response_type' => 'code',
                'access_type' => 'offline',
                'prompt' => 'consent',
            ]),
        ]);
    }

    public function callback(Request $request)
    {
        $code = $request->input('code');

        if (!$code) {
            return response()->json(['error' => 'Authorization code is required'], 400);
        }

        $response = Http::asForm()->post('https://oauth2.googleapis.com/token', [
            'code' => $code,
            'client_id' => env('GOOGLE_CLIENT_ID'),
            'client_secret' => env('GOOGLE_CLIENT_SECRET'),
            'redirect_uri' => env('GOOGLE_REDIRECT_URI'),
            'grant_type' => 'authorization_code',
        ]);

        $tokenData = $response->json();

        if (!isset($tokenData['access_token'])) {
            return response()->json(['error' => 'Failed to get access token'], 400);
        }

        $userResponse = Http::withToken($tokenData['access_token'])->get('https://www.googleapis.com/oauth2/v3/userinfo');
        $googleUser = $userResponse->json();

        if (!isset($googleUser['sub'])) {
            return response()->json(['error' => 'Failed to get user info'], 400);
        }

        $user = User::where('google_id', $googleUser['sub'])->first();

        if (!$user) {
            $user = User::create([
                'name' => $googleUser['name'] ?? $googleUser['email'],
                'email' => $googleUser['email'],
                'google_id' => $googleUser['sub'],
                'avatar' => $googleUser['picture'] ?? null,
                'is_google_user' => true,
                'password' => Hash::make(Str::random(32)),
            ]);
        }

        $token = $user->createToken('auth-token')->plainTextToken;

        return response()->json([
            'user' => $user,
            'token' => $token,
        ]);
    }
}
