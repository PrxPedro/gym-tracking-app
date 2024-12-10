@extends('layouts.app')

@section('title', 'Edit Profile')

@section('content')
<div class="container py-5" 
     style="max-width: 600px; margin: 0 auto; background-color: #1a2b48; color: #ffffff; border-radius: 10px; padding: 30px; box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);">
    <h2 style="font-size: 2.5rem; font-weight: bold; text-align: center; margin-bottom: 30px;">Edit Profile</h2>

    <form action="{{ route('profile.update', $user->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

          <!-- Profile Picture Preview -->
        <div style="display: flex; justify-content: center; margin-bottom: 1rem;">
            <div class="text-center">
                <label for="profile_picture" style="cursor: pointer;">
                    <img id="profilePicturePreview" src="{{ $user->profile && $user->profile->profile_picture ? asset('storage/' . $user->profile->profile_picture) : 'https://via.placeholder.com/150' }}" alt="Profile Picture" style="width: 150px; height: 150px; border-radius: 50%; object-fit: cover; border: 3px solid #ffffff; margin-bottom: 20px; margin-left: 70px;">
                </label>
                <input type="file" id="profile_picture" name="profile_picture" style="display: none;" onchange="previewImage(event)">
                <p style="margin-top: 10px; font-size: 0.9rem; color: #cccccc;">Click the image to change your profile picture</p>
            </div>
        </div>

        <!-- Bio -->
        <div class="text-center mb-4">
            <label for="bio" style="font-weight: bold; font-size: 1.5rem; display: block; margin-bottom: 10px;">Bio</label>
            <textarea id="bio" name="bio" class="form-control" rows="4" 
                      style="background-color: #243b5e; color: #ffffff; border: none; padding: 10px; border-radius: 5px; font-size: 1.2rem; text-align: center; margin: 0 auto; max-width: 400px;">{{ old('bio', $user->profile->bio) }}</textarea>
        </div>

        <!-- Submit Button -->
        <div class="form-group text-center">
            <button type="submit" class="btn btn-primary" 
                    style="background-color: #007bff; border: none; padding: 10px 20px; font-size: 1.2rem; border-radius: 5px;">
                Update Profile
            </button>
        </div>
    </form>
</div>

<script>
    // JavaScript for live image preview
    function previewImage(event) {
        const reader = new FileReader();
        reader.onload = function() {
            const output = document.getElementById('profilePicturePreview');
            output.src = reader.result;
        };
        reader.readAsDataURL(event.target.files[0]);
    }
</script>
@endsection
