@extends('layouts.app')

@section('content')
<div class="container mx-auto py-8">
    <!-- Dashboard Statistics -->
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6 my-8 py-6 bg-gray-900 rounded-lg shadow-lg">
        <!-- Total Users -->
        <div class="p-6 bg-gray-800 rounded-lg shadow-lg text-center flex flex-col items-center text-white">
            <h2 class="text-white text-xl font-bold mb-2">Total Users</h2>
            <p class="text-blue-400 text-5xl font-bold">{{ $totalUsers }}</p>
        </div>

        <!-- Total Posts -->
        <div class="p-6 bg-gray-800 rounded-lg shadow-lg text-center flex flex-col items-center text-white">
            <h2 class="text-white text-xl font-bold mb-2">Total Posts</h2>
            <p class="text-blue-400 text-5xl font-bold">{{ $totalPosts }}</p>
        </div>

        <!-- Average Rating -->
        <div class="p-6 bg-gray-800 rounded-lg shadow-lg text-center flex flex-col items-center text-white">
            <h2 class="text-white text-xl font-bold mb-2">Avg Rating</h2>
            <p class="text-blue-400 text-5xl font-bold">
                {{ $avgRating !== null ? number_format($avgRating, 2) : 'N/A' }}
            </p>
        </div>
    </div>

    <!-- Workouts Table -->
    <div class="bg-gray-800 p-6 rounded-lg shadow-lg mt-8">
        <h2 class="text-white text-2xl font-bold mb-4">Workouts</h2>
        <table class="w-full text-left table-auto border-collapse border border-gray-700">
            <thead>
                <tr class="bg-gray-700">
                    <th class="px-4 py-2 text-gray-300 border border-gray-600">Workout Title</th>
                    <th class="px-4 py-2 text-gray-300 border border-gray-600">Exercises</th>
                    <th class="px-4 py-2 text-gray-300 border border-gray-600">Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($workouts as $workout)
                    <tr class="hover:bg-gray-700 transition duration-150">
                        <td class="px-4 py-2 text-white border border-gray-600">{{ $workout->name }}</td>
                        <td class="px-4 py-2 text-white border border-gray-600">
                            {{ $workout->exercises->count() }} Exercises
                        </td>
                        <td class="px-4 py-2 text-white border border-gray-600">
                            <a href="{{ route('workouts.edit', $workout->id) }}" class="text-blue-400 hover:underline">Edit</a>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="3" class="px-4 py-2 text-gray-300 text-center">No workouts available</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection
