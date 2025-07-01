<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\AuthController;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\AttendanceController;

Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);

Route::middleware('auth:sanctum')->group(function () {
    Route::get('/students', [StudentController::class, 'index']);         // List all students
    Route::post('/students', [StudentController::class, 'store']);        // Register a new student
    Route::put('/students/{id}', [StudentController::class, 'update']);   // Update student
    Route::delete('/students/{id}', [StudentController::class, 'destroy']);
    Route::get('/students/nfc/{id}', [StudentController::class, 'getByNfcId']);
// Delete student

    // 🕒 Attendance Routes
    Route::post('/attendance/mark', [AttendanceController::class, 'mark']);            // Mark attendance via NFC
    Route::get('/attendance/today', [AttendanceController::class, 'today']);           // List today's attendance
    Route::get('/attendance/{id}/history', [AttendanceController::class, 'history']); 
    Route::get('/user', function (Request $request) {
        return $request->user();
    });
    Route::post('/logout', [AuthController::class, 'logout']);
});
