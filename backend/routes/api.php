<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\Auth\ForgotPasswordController;
use App\Http\Controllers\GoogleController;
use App\Http\Controllers\MayaCalendarController;
use App\Http\Controllers\KinController;
use App\Http\Controllers\WavespellController;
use App\Http\Controllers\CastleController;
use App\Http\Controllers\OracleController;
use App\Http\Controllers\UserCalendarController;
use App\Http\Controllers\UserProfileController;
use App\Http\Controllers\UserReadingController;

Route::middleware('auth:sanctum')->group(function () {
    Route::post('/logout', [AuthController::class, 'logout']);
    Route::get('/me', [AuthController::class, 'me']);

    Route::prefix('user')->group(function () {
        Route::get('/kin-today', [UserCalendarController::class, 'getTodayKin']);
        Route::get('/history', [UserCalendarController::class, 'getHistory']);
        Route::post('/save-kin', [UserCalendarController::class, 'saveDailyKin']);
        Route::get('/profile', [UserProfileController::class, 'getProfile']);
        Route::put('/profile', [UserProfileController::class, 'updateProfile']);
        Route::get('/readings', [UserReadingController::class, 'getReadings']);
        Route::post('/readings', [UserReadingController::class, 'saveReading']);
        Route::get('/readings/{readingId}', [UserReadingController::class, 'getReading']);
        Route::put('/readings/{readingId}', [UserReadingController::class, 'updateReading']);
        Route::delete('/readings/{readingId}', [UserReadingController::class, 'deleteReading']);
    });
});

Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);
Route::post('/google', [AuthController::class, 'google']);
Route::post('/forgot-password', [ForgotPasswordController::class, 'sendEmail']);
Route::post('/reset-password', [ForgotPasswordController::class, 'reset']);

Route::get('/auth/google', [GoogleController::class, 'redirect']);
Route::get('/auth/google/callback', [GoogleController::class, 'callback']);

Route::prefix('calendar')->group(function () {
    Route::get('/today', [MayaCalendarController::class, 'today']);
    Route::get('/date/{date}', [MayaCalendarController::class, 'date']);
    Route::get('/kin/{kinId}', [MayaCalendarController::class, 'getKinByNumber']);
    Route::get('/wavespell/today', [MayaCalendarController::class, 'getWavespellToday']);
    Route::get('/wavespell/{wavespellId}', [MayaCalendarController::class, 'getWavespellByNumber']);
    Route::get('/castle/today', [MayaCalendarController::class, 'getCastleToday']);
    Route::get('/castle/{castleId}', [MayaCalendarController::class, 'getCastleByNumber']);
    Route::get('/oracle/{kinId}', [MayaCalendarController::class, 'getOracleByKin']);
});

Route::prefix('kins')->group(function () {
    Route::get('/', [KinController::class, 'index']);
    Route::get('/gaps', [KinController::class, 'gaps']);
    Route::get('/core-days', [KinController::class, 'coreDays']);
    Route::get('/search/seal/{seal}', [KinController::class, 'searchBySeal']);
    Route::get('/search/tone/{tone}', [KinController::class, 'searchByTone']);
    Route::get('/search/color/{color}', [KinController::class, 'searchByColor']);
    Route::get('/{kinId}', [KinController::class, 'show']);
});

Route::prefix('wavespells')->group(function () {
    Route::get('/', [WavespellController::class, 'index']);
    Route::get('/{wavespellId}', [WavespellController::class, 'show']);
    Route::get('/{wavespellId}/kins', [WavespellController::class, 'kins']);
});

Route::prefix('castles')->group(function () {
    Route::get('/', [CastleController::class, 'index']);
    Route::get('/{castleId}', [CastleController::class, 'show']);
    Route::get('/{castleId}/kins', [CastleController::class, 'kins']);
});

Route::prefix('oracles')->group(function () {
    Route::get('/{kinId}', [OracleController::class, 'getOracle']);
    Route::get('/{kinId}/interpretation', [OracleController::class, 'getInterpretation']);
});
