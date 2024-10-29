<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\Auth\RegisteredUserController;
use App\Http\Controllers\Auth\PasswordResetLinkController;
use App\Http\Controllers\Auth\NewPasswordController;
use App\Http\Controllers\WorkoutController; 
use App\Http\Controllers\ExerciseController;
use App\Http\Controllers\DashboardController; 
use App\Http\Controllers\ForumController;
use App\Http\Controllers\DiscussionController;
use App\Http\Controllers\PostController;

// Home route (landing page)
Route::get('/', function () {
    return view('landing'); // Points to the landing page view
})->name('home');

// Workout Plans routes
Route::resource('workouts', WorkoutController::class); // Handles CRUD operations for workouts
Route::post('/workouts/{workout}/rate', [WorkoutController::class, 'rate'])->name('workouts.rate'); // Rate a workout
Route::resource('workouts.exercises', ExerciseController::class); // Handles CRUD operations for exercises within workouts

// Forum routes
Route::get('/forums', [ForumController::class, 'index'])->name('forums.index'); // Shows all forums
Route::get('/forums/{forum}', [ForumController::class, 'show'])->name('forums.show'); // Shows a single forum and its discussions

// Discussion routes
Route::post('/forums/{forum}/discussions', [DiscussionController::class, 'store'])->name('discussions.store'); // Creates a new discussion in a forum

// Community routes
Route::get('/community', [PostController::class, 'index'])->name('community.index'); // Shows all community posts
Route::post('/community/store', [PostController::class, 'store'])->name('community.store'); // Handles creating a new community post

// Authentication routes
Route::get('/login', [AuthenticatedSessionController::class, 'create'])->name('login'); // Login page
Route::post('/login', [AuthenticatedSessionController::class, 'store']); // Handles login submission
Route::post('/logout', [AuthenticatedSessionController::class, 'destroy'])->name('logout'); // Logs out the user

// Registration routes
Route::get('/register', [RegisteredUserController::class, 'create'])->name('register'); // Registration page
Route::post('/register', [RegisteredUserController::class, 'store']); // Handles registration submission

// Dashboard route - requires authentication
Route::middleware(['auth'])->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard'); // Authenticated dashboard
});

// Password Reset routes
Route::get('/forgot-password', [PasswordResetLinkController::class, 'create'])->name('password.request'); // Forgot password page
Route::post('/forgot-password', [PasswordResetLinkController::class, 'store'])->name('password.email'); // Sends password reset link
Route::get('/reset-password/{token}', [NewPasswordController::class, 'create'])->name('password.reset'); // Password reset page with token
Route::post('/reset-password', [NewPasswordController::class, 'store'])->name('password.update'); // Handles password reset submission
