@extends('layouts.app')

@section('title', '{{ $user->profile->username ?? $user->name }}\'s Profile')

@section('content')
<div class="container py-5" 
     style="max-width: 1100px; margin: 0 auto; background-color: #1a2b48; color: #ffffff; border-radius: 10px; padding: 30px;">
    <div class="row">
        <!-- Profile Header -->
        <div class="col-md-12" style="display: flex; align-items: center;">
            <!-- Profile Picture -->
            <div style="margin-right: 30px;">
                <img src="{{ $user->profile && $user->profile->profile_picture ? asset('storage/' . $user->profile->profile_picture) : 'https://via.placeholder.com/150' }}" 
                     alt="Profile Picture" 
                     style="width: 200px; height: 200px; border-radius: 50%; object-fit: cover; border: 3px solid #ffffff;">
            </div>
            <!-- Profile Info -->
            <div style="flex: 1;">
                <h1 style="font-size: 3rem; font-weight: bold; margin: 0;">{{ $user->profile->username ?? $user->name }}</h1>
                <p style="color: #cccccc; font-size: 1.2rem; margin-top: 10px;">{{ $user->profile->bio ?? 'No bio provided.' }}</p>
                @if (auth()->id() == $user->id)
                    <a href="{{ route('profile.edit', $user->id) }}" 
                       class="btn btn-primary" 
                       style="background-color: #007bff; border: none; margin-top: 10px;">Edit Profile</a>
                @endif
            </div>
        </div>

        <!-- User Posts -->
        <div class="col-md-12 mt-5">
            <h4 style="font-weight: bold; border-bottom: 2px solid #ffffff; padding-bottom: 10px; font-size: 1.8rem;">User Posts</h4>
            <div class="row">
                @forelse ($user->posts as $post)
                    <div class="col-md-12 mb-3">
                        <a href="{{ route('community.show', $post->id) }}" 
                           style="text-decoration: none;">
                            <div class="card post-card" 
                                 style="background-color: #243b5e; border-radius: 10px; padding: 20px; box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2); color: #ffffff; transition: transform 0.2s, box-shadow 0.2s;">
                                <div class="card-body">
                                    <h5 class="card-title" style="color: #ffffff; font-weight: bold;">{{ $post->title }}</h5>
                                    <p class="card-text" style="color: #cccccc;">{{ $post->content }}</p>
                                    <p class="text-muted" style="font-size: 0.9em;">Posted by {{ $user->profile->username ?? $user->name }}</p>
                                </div>
                            </div>
                        </a>
                    </div>
                @empty
                    <div class="col-md-12">
                        <p class="text-center" style="color: #cccccc;">No posts available.</p>
                    </div>
                @endforelse
            </div>
        </div>
    </div>
</div>

<!-- Inline CSS for Hover Effects -->
<style>
    .post-card:hover {
        transform: scale(1.02); /* Slightly enlarge the card */
        box-shadow: 0 6px 12px rgba(0, 0, 0, 0.3); /* Darker shadow */
        background-color: #2c4a70; /* Slightly lighter background */
        cursor: pointer; /* Change cursor to indicate it's clickable */
    }
</style>
@endsection
