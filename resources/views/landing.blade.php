
@extends('layouts.app')

@section('content')
<div class="flex items-center justify-center min-h-screen bg-gradient-to-br from-indigo-900 via-gray-900 to-indigo-700">
    <div class="text-center">
        <!-- Welcome Heading -->
        <h1 class="text-[16rem] font-extrabold text-white mb-12 tracking-wide leading-tight">
            Welcome to <span class="text-blue-400">Gym Tracking App</span>!
        </h1>
        
        <!-- Description -->
        <p class="text-[8rem] text-gray-300 mb-16 leading-relaxed">
            Track your workouts and manage your fitness progress with ease.
        </p>

        <!-- Call-to-Action Button -->
        @if (Route::has('login'))
            <div class="mt-8">
                @auth
                    <a href="{{ url('/workouts') }}" 
                       class="px-16 py-8 bg-blue-500 text-white text-[4rem] font-semibold rounded-full shadow-lg hover:bg-blue-400 transition-all duration-300">
                        Go to Workouts
                    </a>
                @else
                    <a href="{{ route('login') }}" 
                       class="px-16 py-8 bg-green-500 text-white text-[4rem] font-semibold rounded-full shadow-lg hover:bg-green-400 transition-all duration-300">
                        Login
                    </a>
                    @if (Route::has('register'))
                        <a href="{{ route('register') }}" 
                           class="px-16 py-8 bg-purple-500 text-white text-[4rem] font-semibold rounded-full shadow-lg hover:bg-purple-400 transition-all duration-300 ml-6">
                            Sign Up
                        </a>
                    @endif
                @endauth
            </div>
        @endif
    </div>
</div>
@endsection