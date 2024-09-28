@extends('layouts.app')

@section('content')
<div class="container mx-auto p-4">
    <h1 class="text-4xl font-bold text-gray-800 dark:text-gray-200 mb-4">{{ $workout->name }}</h1>
    <p class="text-lg text-gray-600 dark:text-gray-400 mb-6">{{ $workout->description }}</p>

    <h2 class="text-2xl font-semibold text-gray-800 dark:text-gray-200 mb-2">Exercises:</h2>

    @if ($workout->exercises->isEmpty())
        <p class="text-gray-600 dark:text-gray-400">No exercises available for this workout.</p>
    @else
        <ul class="space-y-4">
            @foreach ($workout->exercises as $exercise)
                <li class="p-4 border rounded-lg bg-white dark:bg-gray-700">
                    <h3 class="text-xl font-semibold text-gray-800 dark:text-gray-200">{{ $exercise->name }}</h3>
                    <p class="text-gray-600 dark:text-gray-400">Sets: {{ $exercise->sets }}, Reps: {{ $exercise->reps }}</p>
                </li>
            @endforeach
        </ul>
    @endif

    <h2 class="text-2xl font-semibold text-gray-800 dark:text-gray-200 mt-6">Add New Exercise:</h2>
    <form method="POST" action="{{ route('workouts.exercises.store', $workout) }}" class="mt-4">
        @csrf
        <div>
            <label for="name" class="block text-gray-800 dark:text-gray-200">Exercise Name:</label>
            <input type="text" name="name" required class="border rounded-lg p-2 w-full">
        </div>
        <div class="mt-2">
            <label for="sets" class="block text-gray-800 dark:text-gray-200">Sets:</label>
            <input type="number" name="sets" required class="border rounded-lg p-2 w-full">
        </div>
        <div class="mt-2">
            <label for="reps" class="block text-gray-800 dark:text-gray-200">Reps:</label>
            <input type="number" name="reps" required class="border rounded-lg p-2 w-full">
        </div>
        <button type="submit" class="mt-4 bg-blue-600 text-white rounded-lg px-4 py-2 hover:bg-blue-700">Add Exercise</button>
    </form>
</div>
@endsection
