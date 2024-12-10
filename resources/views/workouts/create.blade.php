@extends('layouts.app')

@section('content')
<div class="container mx-auto p-6 text-gray-800 dark:text-gray-200">
    <h1 class="text-4xl font-bold mb-4">Create Workout</h1>

    <form method="POST" action="{{ route('workouts.store') }}" class="bg-gray-800 p-6 rounded-lg shadow-md">
        @csrf
        <div class="mb-4">
            <label for="name" class="block text-white">Name:</label>
            <input type="text" name="name" id="name" class="w-full p-2 border rounded-lg bg-gray-700 text-black" required>
        </div>
        <div class="mb-4">
            <label for="category" class="block text-white">Category:</label>
            <select name="category" id="category" class="w-full p-2 border rounded-lg bg-gray-700 text-black" required>
                <option value="Push">Push</option>
                <option value="Pull">Pull</option>
                <option value="Legs">Legs</option>
                <option value="Calisthenics">Calisthenics</option>
                <option value="Core">Core</option>
            </select>
        </div>
        <div class="mb-4">
            <label for="description" class="block text-white">Description:</label>
            <textarea name="description" id="description" class="w-full p-2 border rounded-lg bg-gray-700 text-black"></textarea>
        </div>
        <div class="mb-4">
            <label for="difficulty" class="block text-white">Difficulty:</label>
            <select name="difficulty" id="difficulty" class="w-full p-2 border rounded-lg bg-gray-700 text-black" required>
                <option value="Easy">Easy</option>
                <option value="Medium">Medium</option>
                <option value="Hard">Hard</option>
            </select>
        </div>
        <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded-lg hover:bg-blue-700">Create</button>
    </form>
</div>
@endsection