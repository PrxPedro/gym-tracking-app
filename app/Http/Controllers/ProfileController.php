<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;
use App\Models\User;
use Illuminate\Support\Facades\Storage;

class ProfileController extends Controller
{ 
        use AuthorizesRequests;
        // Show a user's profile
        public function show(User $user)
        {
            if (!$user->profile) {
                $user->profile()->create([
                    'username' => $user->name,
                    'bio' => null,
                    'profile_picture' => null,
                ]);
            }

            $user->load('profile', 'posts'); // Eager load profile and posts
            return view('profile.show', compact('user'));
        }

    
        // Edit a user's profile
        public function edit(User $user)
            {
                // Only allow the user themselves or an admin to edit the profile
                if (auth()->id() !== $user->id && auth()->user()->role !== 'admin') {
                    abort(403, 'Unauthorized access.');
                }

                return view('profile.edit', compact('user'));
            }

    
        // Update a user's profile
        public function update(Request $request, User $user)
        {
            // Ensure only the user or an admin can update the profile
            if (auth()->id() !== $user->id && auth()->user()->role !== 'admin') {
                abort(403, 'Unauthorized access.');
            }

            $request->validate([
                'bio' => 'nullable|string|max:255',
                'profile_picture' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            ]);

            // Update bio
            $user->profile->bio = $request->bio;

            // Update profile picture
            if ($request->hasFile('profile_picture')) {
                // Delete the old profile picture if it exists
                if ($user->profile->profile_picture) {
                    Storage::delete($user->profile->profile_picture);
                }

                // Store the new profile picture
                $path = $request->file('profile_picture')->store('profile_pictures', 'public');
                $user->profile->profile_picture = $path;
            }

            $user->profile->save();

            return redirect()->route('profile.show', $user->id)->with('success', 'Profile updated successfully!');
        }

    /**
     * Delete the user's account.
     */
    public function destroy(Request $request): RedirectResponse
    {
        $request->validateWithBag('userDeletion', [
            'password' => ['required', 'current_password'],
        ]);

        $user = $request->user();

        Auth::logout();

        $user->delete();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return Redirect::to('/');
    }
}
