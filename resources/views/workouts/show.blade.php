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

    <!-- Exercises Table Section with User Input for Sets -->
    <h2 class="text-2xl font-semibold text-gray-800 dark:text-gray-200 mb-4">Exercises:</h2>
    @if ($workout->exercises->isEmpty())
        <p class="text-gray-600 dark:text-gray-400">No exercises available for this workout.</p>
    @else
        <form method="POST" action="{{ route('workouts.updateSets', $workout) }}">

            @csrf
            <div class="overflow-x-auto">
                <table class="min-w-full bg-white dark:bg-gray-800 rounded-lg shadow-md">
                    <thead>
                        <tr class="bg-gray-100 dark:bg-gray-700 text-gray-800 dark:text-white text-left text-sm uppercase font-semibold">
                            <th class="py-3 px-4">Exercise</th>
                            <th class="py-3 px-4">Last-Set Intensity</th>
                            <th class="py-3 px-4">Technique</th>
                            <th class="py-3 px-4">Warm-up Sets</th>
                            <th class="py-3 px-4">Working Sets</th>
                            <th class="py-3 px-4">Set 1</th>
                            <th class="py-3 px-4">Set 2</th>
                            <th class="py-3 px-4">Set 3</th>
                            <th class="py-3 px-4">Substitution Option</th>
                            <th class="py-3 px-4">Notes</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($workout->exercises as $exercise)
                            <tr class="border-b dark:border-gray-700 text-gray-800 dark:text-white">
                                <td class="py-4 px-4 text-blue-600 dark:text-blue-400">
                                    @if(str_contains($exercise->video_url, 'youtube.com'))
                                        <a href="{{ $exercise->video_url }}" target="_blank" class="hover:underline">{{ $exercise->name }}</a>
                                    @else
                                        <a href="#" @click.prevent="videoUrl = '{{ $exercise->video_url }}'" class="hover:underline">{{ $exercise->name }}</a>
                                    @endif
                                </td>
                                <td class="py-4 px-4">{{ $exercise->last_set_intensity ?? 'N/A' }}</td>
                                <td class="py-4 px-4">{{ $exercise->technique ?? 'N/A' }}</td>
                                <td class="py-4 px-4">{{ $exercise->warm_up_sets ?? 'N/A' }}</td>
                                <td class="py-4 px-4">{{ $exercise->working_sets ?? 'N/A' }}</td>
                                <td class="py-4 px-4"><input type="number" name="sets[{{ $exercise->id }}][set_1]" value="{{ $exercise->set_1 }}" class="border rounded p-2 w-full dark:bg-gray-800 dark:text-gray-200"></td>
                                <td class="py-4 px-4"><input type="number" name="sets[{{ $exercise->id }}][set_2]" value="{{ $exercise->set_2 }}" class="border rounded p-2 w-full dark:bg-gray-800 dark:text-gray-200"></td>
                                <td class="py-4 px-4"><input type="number" name="sets[{{ $exercise->id }}][set_3]" value="{{ $exercise->set_3 }}" class="border rounded p-2 w-full dark:bg-gray-800 dark:text-gray-200"></td>
                                <td class="py-4 px-4">{{ $exercise->substitution_option_1 ?? 'N/A' }}</td>
                                <td class="py-4 px-4">{{ $exercise->notes ?? 'N/A' }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <button type="submit" class="mt-4 bg-blue-600 text-white rounded-lg px-4 py-2 hover:bg-blue-700">Save Sets</button>
        </form>
    @endif

    <!-- Video Popup Modal for Non-YouTube Links -->
    <div x-data="{ videoUrl: null }">
        <div x-show="videoUrl" @click.away="videoUrl = null" class="fixed inset-0 flex items-center justify-center bg-black bg-opacity-50" x-cloak>
            <div class="bg-white dark:bg-gray-800 p-6 rounded-lg shadow-lg max-w-xl w-full">
                <button @click="videoUrl = null" class="text-gray-500 hover:text-gray-700 dark:hover:text-gray-300 absolute top-2 right-2">Close</button>
                <div class="aspect-w-16 aspect-h-9">
                    <iframe x-bind:src="videoUrl" frameborder="0" allowfullscreen class="w-full h-full rounded-lg"></iframe>
                </div>
            </div>
        </div>
    </div>

    <!-- Add New Workout Section -->
    <h2 class="text-2xl font-semibold text-gray-800 dark:text-gray-200 mt-6 mb-2">Create New Workout:</h2>
    <form method="POST" action="{{ route('workouts.store') }}" class="mt-4 bg-white dark:bg-gray-700 p-4 rounded-lg shadow-md">
        @csrf
        <div class="mb-4">
            <label for="name" class="block text-gray-800 dark:text-gray-200">Workout Name:</label>
            <input type="text" name="name" required class="border rounded-lg p-2 w-full dark:bg-gray-800 dark:text-gray-200">
        </div>
        <div class="mb-4">
            <label for="description" class="block text-gray-800 dark:text-gray-200">Description:</label>
            <textarea name="description" required class="border rounded-lg p-2 w-full dark:bg-gray-800 dark:text-gray-200"></textarea>
        </div>
        <div class="mb-4">
            <label for="video_url" class="block text-gray-800 dark:text-gray-200">Instructional Video URL:</label>
            <input type="url" name="video_url" class="border rounded-lg p-2 w-full dark:bg-gray-800 dark:text-gray-200">
        </div>
        <button type="submit" class="mt-4 bg-green-600 text-white rounded-lg px-4 py-2 hover:bg-green-700">Create Workout</button>
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
