@extends('layouts.app')

@section('content')
<div class="container mx-auto py-8">
    <h1 class="text-white text-3xl font-bold mb-6 text-center">Edit Workout</h1>

    <div class="max-w-lg mx-auto bg-gray-800 p-6 rounded-lg shadow-lg">
        <form method="POST" action="{{ route('workouts.update', $workout) }}" class="space-y-6">
            @csrf
            @method('PUT')

            <!-- Name Field -->
            <div>
                <label for="name" class="block text-gray-300 font-semibold mb-2">Workout Name</label>
                <input type="text" name="name" id="name" value="{{ $workout->name }}" 
                       class="w-full p-3 rounded bg-gray-700 text-white border border-gray-600 focus:outline-none focus:ring-2 focus:ring-blue-500" 
                       required>
            </div>

            <!-- Category Field -->
            <div>
                <label for="category" class="block text-gray-300 font-semibold mb-2">Category</label>
                <select name="category" id="category" 
                        class="w-full p-3 rounded bg-gray-700 text-white border border-gray-600 focus:outline-none focus:ring-2 focus:ring-blue-500" 
                        required>
                    <option value="Push" {{ $workout->category == 'Push' ? 'selected' : '' }}>Push</option>
                    <option value="Pull" {{ $workout->category == 'Pull' ? 'selected' : '' }}>Pull</option>
                    <option value="Legs" {{ $workout->category == 'Legs' ? 'selected' : '' }}>Legs</option>
                </select>
            </div>

            <!-- Description Field -->
            <div>
                <label for="description" class="block text-gray-300 font-semibold mb-2">Description</label>
                <textarea name="description" id="description" rows="5" 
                          class="w-full p-3 rounded bg-gray-700 text-white border border-gray-600 focus:outline-none focus:ring-2 focus:ring-blue-500">{{ $workout->description }}</textarea>
            </div>

            <!-- Submit Button -->
            <div class="flex justify-center">
                <button type="submit" 
                        class="px-6 py-3 bg-blue-600 text-white font-semibold rounded hover:bg-blue-700 transition duration-200">
                    Update Workout
                </button>
            </div>
        </form>
    </div>
</div>
@endsection
