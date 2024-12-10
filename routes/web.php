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
use App\Http\Controllers\CalorieController;
use App\Http\Controllers\NotificationController;
use App\Http\Middleware\AdminMiddleware;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\MessageController;

// Home route (landing page)
Route::get('/', function () {
    return view('landing'); // Points to the landing page view
})->name('home');

// Workout Plans routes
Route::resource('workouts', WorkoutController::class); // Handles CRUD operations for workouts
Route::post('/workouts/{workout}/rate', [WorkoutController::class, 'rate'])->name('workouts.rate'); // Rate a workout
Route::resource('workouts.exercises', ExerciseController::class); // Handles CRUD operations for exercises within workouts
Route::post('/workouts/{workout}/update-sets', [WorkoutController::class, 'updateSets'])->name('workouts.updateSets');

// Post routes
Route::get('/posts/{post}', [PostController::class, 'show'])->name('posts.show'); // Shows a single post

// Community routes
// Ensure /community/messages is defined before /community/{post} to avoid conflicts
Route::get('/community/messages', [MessageController::class, 'userMessages'])->name('community.messages'); // User messages
Route::get('/community', [PostController::class, 'index'])->name('community.index'); // Shows all community posts
Route::post('/community/store', [PostController::class, 'store'])->name('community.store'); // Handles creating a new community post
Route::get('/community/{post}', [PostController::class, 'show'])->name('community.show'); // Shows a single community post
Route::post('/posts/{post}/messages', [MessageController::class, 'store'])->name('messages.store');

// Calorie routes
Route::get('/calorie-calculator', [CalorieController::class, 'index'])->name('calorie.index'); // Calorie calculator form
Route::post('/calorie-calculator', [CalorieController::class, 'calculate'])->name('calorie.calculate'); // Calorie calculation results

// Forum routes
Route::get('/forums', [ForumController::class, 'index'])->name('forums.index'); // Shows all forums
Route::get('/forums/{forum}', [ForumController::class, 'show'])->name('forums.show'); // Shows a single forum and its discussions

// Discussion routes
Route::post('/forums/{forum}/discussions', [DiscussionController::class, 'store'])->name('discussions.store'); // Creates a new discussion in a forum

// Notification routes
Route::middleware(['auth'])->group(function () {
    Route::get('/notifications', [NotificationController::class, 'fetchNotifications']);
    Route::post('/notifications/{id}/mark-as-read', [NotificationController::class, 'markAsRead']);
});


// Authentication routes
Route::get('/login', [AuthenticatedSessionController::class, 'create'])->name('login'); // Login page
Route::post('/login', [AuthenticatedSessionController::class, 'store']); // Handles login submission
Route::post('/logout', [AuthenticatedSessionController::class, 'destroy'])->name('logout'); // Logs out the user

// Registration routes
Route::get('/register', [RegisteredUserController::class, 'create'])->name('register'); // Registration page
Route::post('/register', [RegisteredUserController::class, 'store']); // Handles registration submission

// Authenticated User Dashboard
Route::middleware(['auth'])->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard'); // Authenticated dashboard
});

// Password Reset routes
Route::get('/forgot-password', [PasswordResetLinkController::class, 'create'])->name('password.request'); // Forgot password page
Route::post('/forgot-password', [PasswordResetLinkController::class, 'store'])->name('password.email'); // Sends password reset link
Route::get('/reset-password/{token}', [NewPasswordController::class, 'create'])->name('password.reset'); // Password reset page with token
Route::post('/reset-password', [NewPasswordController::class, 'store'])->name('password.update'); // Handles password reset submission

// Profile routes
Route::get('/profile/{user}', [ProfileController::class, 'show'])->name('profile.show'); // Show user profile
Route::middleware(['auth'])->group(function () {
    Route::get('/profile/{user}/edit', [ProfileController::class, 'edit'])->name('profile.edit'); // Edit profile form
    Route::put('/profile/{user}', [ProfileController::class, 'update'])->name('profile.update'); // Update profile logic
});


// Admin routes (accessible only by admins)
Route::middleware(['auth'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'adminDashboard'])->name('dashboard'); // Admin dashboard
    Route::get('/accounts', [DashboardController::class, 'manageAccounts'])->name('accounts'); // Manage user accounts
    Route::post('/accounts/{user}/ban', [DashboardController::class, 'banUser'])->name('accounts.ban'); // Ban a user
    Route::get('/accounts/{user}/edit', [DashboardController::class, 'editAccount'])->name('accounts.edit'); // Edit user account
    Route::post('/accounts/{user}/update', [DashboardController::class, 'updateAccount'])->name('accounts.update'); // Update user account

    // Admin Messages Management
    Route::get('/messages', [MessageController::class, 'adminMessages'])->name('messages');
    Route::delete('/messages/{message}', [MessageController::class, 'deleteMessage'])->name('messages.delete');
    Route::get('/messages/{message}/edit', [MessageController::class, 'editMessage'])->name('messages.edit');
    Route::put('/messages/{message}', [MessageController::class, 'updateMessage'])->name('messages.update');
});