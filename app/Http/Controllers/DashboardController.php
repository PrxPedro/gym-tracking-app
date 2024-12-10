<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Post;
use App\Models\Workout;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function adminDashboard()
    {
        // Fetch total users
        $totalUsers = User::count();

        // Fetch total posts
        $totalPosts = Post::count();

        // Calculate average rating
        $avgRating = \App\Models\Rating::avg('rating'); // Ensure 'rating' is the column name in the ratings table

        // Fetch workouts with exercises (if needed for the table)
        $workouts = Workout::with('exercises')->get();

        // Pass data to the view
        return view('admin.dashboard', compact('totalUsers', 'totalPosts', 'avgRating', 'workouts'));
    }
    public function manageAccounts()
    {
        $users = User::all();
        return view('admin.accounts', compact('users'));
    }

    public function manageMessages()
    {
        $messages = Post::latest()->get();
        return view('admin.messages', compact('messages'));
    }

    public function banUser(User $user)
    {
        $user->update(['banned' => true]);
        return redirect()->route('admin.accounts')->with('success', 'User has been banned.');
    }

    public function editAccount(User $user)
    {
        return view('profile.edit', compact('user'));
    }

    public function updateAccount(Request $request, User $user)
    {
        $request->validate([
            'name' => 'required|max:255',
            'email' => 'required|email',
            'role' => 'required|in:admin,user',
        ]);

        $user->update($request->only(['name', 'email', 'role']));

        return redirect()->route('admin.accounts')->with('success', 'Account updated successfully.');
    }

    public function index()
    {
        return view('dashboard');
    }
}
