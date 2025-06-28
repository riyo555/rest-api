<?php

use App\Http\Controllers\MahasiswaController;
use Illuminate\Support\Facades\Route;

Route::apiResource('/mahasiswa', MahasiswaController::class);
Route::get('/test-api', function () {
    return response()->json(['status' => 'API OK']);
});
