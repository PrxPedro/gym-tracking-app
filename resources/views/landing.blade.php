@extends('layouts.app')

@section('content')
<div class="flex items-center justify-center min-h-screen bg-gray-100 dark:bg-gray-900">
    <div class="text-center">
        <h1 class="text-4xl font-bold text-gray-800 dark:text-gray-200 mb-4">Welcome to the Gym Tracking App!</h1>
        <p class="text-lg text-gray-600 dark:text-gray-400 mb-6">Track your workouts, manage your fitness progress, and connect with others.</p>

        @if (Route::has('login'))
            <div class="mt-4">
                @auth
                    <a href="{{ url('/workouts') }}" class="px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700">Workouts</a>
                @else
                    <a href="{{ route('login') }}" class="px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700">Login</a>
                    @if (Route::has('register'))
                        <a href="{{ route('register') }}" class="px-4 py-2 bg-green-600 text-white rounded hover:bg-green-700 ml-2">Sign Up</a>
                    @endif
                @endauth
            </div>
        @endif
    </div>
</div>
@endsection
