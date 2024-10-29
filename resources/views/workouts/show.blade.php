@extends('layouts.app')

@section('content')
<div class="container mx-auto p-6">
    <h1 class="text-4xl font-bold text-gray-800 dark:text-gray-200 mb-4">{{ $workout->name }}</h1>
    <p class="text-lg text-gray-600 dark:text-gray-400 mb-6">{{ $workout->description }}</p>

    <!-- Instructional Video Section for Workout -->
    @if($workout->video_url)
        <div class="mb-6">
            <h2 class="text-2xl font-semibold text-gray-800 dark:text-gray-200 mb-2">Instructional Video:</h2>
            <iframe width="560" height="315" src="{{ $workout->video_url }}" frameborder="0" allowfullscreen class="rounded-lg shadow-md"></iframe>
        </div>
    @endif

    <!-- Exercises List Section with Video Links -->
    <h2 class="text-2xl font-semibold text-gray-800 dark:text-gray-200 mb-4">Exercises:</h2>
    @if ($workout->exercises->isEmpty())
        <p class="text-gray-600 dark:text-gray-400">No exercises available for this workout.</p>
    @else
        <ul class="space-y-4" x-data="{ videoUrl: null }">
            @foreach ($workout->exercises as $exercise)
                <li class="p-4 border rounded-lg bg-white dark:bg-gray-700 shadow-md">
                    <h3 class="text-xl font-semibold text-gray-800 dark:text-gray-200">
                        @if(str_contains($exercise->video_url, 'youtube.com'))
                            <!-- Open YouTube links in a new tab -->
                            <a href="{{ $exercise->video_url }}" target="_blank" class="hover:underline text-blue-600 dark:text-blue-400">{{ $exercise->name }}</a>
                        @else
                            <!-- Show modal for other links -->
                            <a href="#" @click.prevent="videoUrl = '{{ $exercise->video_url }}'" class="hover:underline text-blue-600 dark:text-blue-400">{{ $exercise->name }}</a>
                        @endif
                    </h3>
                    <p class="text-gray-600 dark:text-gray-400">Sets: {{ $exercise->sets }}, Reps: {{ $exercise->reps }}</p>
                </li>
            @endforeach

            <!-- Video Popup Modal for Non-YouTube Links -->
            <div x-show="videoUrl" @click.away="videoUrl = null" class="fixed inset-0 flex items-center justify-center bg-black bg-opacity-50" x-cloak>
                <div class="bg-white dark:bg-gray-800 p-6 rounded-lg shadow-lg max-w-xl w-full">
                    <button @click="videoUrl = null" class="text-gray-500 hover:text-gray-700 dark:hover:text-gray-300 absolute top-2 right-2">Close</button>
                    <div class="aspect-w-16 aspect-h-9">
                        <iframe x-bind:src="videoUrl" frameborder="0" allowfullscreen class="w-full h-full rounded-lg"></iframe>
                    </div>
                </div>
            </div>
        </ul>
    @endif

    <!-- Add New Exercise Form -->
    <h2 class="text-2xl font-semibold text-gray-800 dark:text-gray-200 mt-6 mb-2">Add New Exercise:</h2>
    <form method="POST" action="{{ route('workouts.exercises.store', $workout) }}" class="mt-4 bg-white dark:bg-gray-700 p-4 rounded-lg shadow-md">
        @csrf
        <div class="mb-4">
            <label for="name" class="block text-gray-800 dark:text-gray-200">Exercise Name:</label>
            <input type="text" name="name" required class="border rounded-lg p-2 w-full dark:bg-gray-800 dark:border-gray-600 dark:text-gray-200">
        </div>
        <div class="mb-4">
            <label for="sets" class="block text-gray-800 dark:text-gray-200">Sets:</label>
            <input type="number" name="sets" required class="border rounded-lg p-2 w-full dark:bg-gray-800 dark:border-gray-600 dark:text-gray-200">
        </div>
        <div class="mb-4">
            <label for="reps" class="block text-gray-800 dark:text-gray-200">Reps:</label>
            <input type="number" name="reps" required class="border rounded-lg p-2 w-full dark:bg-gray-800 dark:border-gray-600 dark:text-gray-200">
        </div>
        <button type="submit" class="mt-4 bg-blue-600 text-white rounded-lg px-4 py-2 hover:bg-blue-700">Add Exercise</button>
    </form>

    <!-- Rating Section -->
    <h2 class="text-2xl font-semibold text-gray-800 dark:text-gray-200 mt-6 mb-2">Rate this Workout:</h2>
    <form method="POST" action="{{ route('workouts.rate', $workout) }}" class="mt-4 bg-white dark:bg-gray-700 p-4 rounded-lg shadow-md">
        @csrf
        <div class="mb-4">
            <label for="rating" class="block text-gray-800 dark:text-gray-200">Select Rating:</label>
            <select name="rating" required class="border rounded-lg p-2 w-full dark:bg-gray-800 dark:border-gray-600 dark:text-gray-200">
                <option value="">Select Rating</option>
                <option value="1">1 Star</option>
                <option value="2">2 Stars</option>
                <option value="3">3 Stars</option>
                <option value="4">4 Stars</option>
                <option value="5">5 Stars</option>
            </select>
        </div>
        <button type="submit" class="mt-2 bg-blue-600 text-white rounded-lg px-4 py-2 hover:bg-blue-700">Submit Rating</button>
    </form>

    <!-- Display Average Rating -->
    @if ($workout->ratings && $workout->ratings->count() > 0)
        <h3 class="text-lg mt-6 text-gray-800 dark:text-gray-200">Average Rating: 
            <span class="text-yellow-500">{{ number_format($workout->ratings->average('rating'), 1) }} Stars</span>
        </h3>
    @else
        <p class="text-gray-600 dark:text-gray-400 mt-4">No ratings available for this workout.</p>
    @endif
</div>
@endsection
