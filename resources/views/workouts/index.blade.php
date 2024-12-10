@extends('layouts.app')

@section('content')
<div class="container mx-auto p-4">
    <h1 class="text-4xl font-bold text-gray-800 dark:text-gray-200 mb-4">Workouts</h1>

    <form method="GET" action="{{ route('workouts.index') }}" class="mb-4 flex gap-2">
        <input type="text" name="search" placeholder="Search Workouts" class="border rounded-lg p-2" value="{{ request('search') }}">
        <select name="category" class="border rounded-lg p-2">
            <option value="">All Categories</option>
            <option value="Push" {{ request('category') == 'Push' ? 'selected' : '' }}>Push</option>
            <option value="Pull" {{ request('category') == 'Pull' ? 'selected' : '' }}>Pull</option>
            <option value="Legs" {{ request('category') == 'Legs' ? 'selected' : '' }}>Legs</option>
            <option value="Calisthenics" {{ request('category') == 'Calisthenics' ? 'selected' : '' }}>Calisthenics</option>
            <option value="Core" {{ request('category') == 'Core' ? 'selected' : '' }}>Core</option>
            <option value="Arms/Shoulders" {{ request('category') == 'Arms/Shoulders' ? 'selected' : '' }}>Arms/Shoulders</option>
            <option value="Functional" {{ request('category') == 'Functional' ? 'selected' : '' }}>Functional</option>
            <option value="Full Body" {{ request('category') == 'Full Body' ? 'selected' : '' }}>Full Body</option>
            <option value="Mobility" {{ request('category') == 'Mobility' ? 'selected' : '' }}>Mobility</option>
        </select>

        <select name="difficulty" class="border rounded-lg p-2">
            <option value="">All Difficulties</option>
            <option value="Easy" {{ request('difficulty') == 'Easy' ? 'selected' : '' }}>Easy</option>
            <option value="Medium" {{ request('difficulty') == 'Medium' ? 'selected' : '' }}>Medium</option>
            <option value="Hard" {{ request('difficulty') == 'Hard' ? 'selected' : '' }}>Hard</option>
        </select>
        <button type="submit" class="bg-blue-600 text-white rounded-lg px-4 py-2 hover:bg-blue-700">Filter</button>
    </form>

    <ul class="space-y-4">
        @foreach ($workouts as $workout)
            <li class="p-4 border rounded-lg bg-white dark:bg-gray-700">
                <div class="flex justify-between items-center">
                    <div>
                        <h2 class="text-2xl font-semibold text-gray-800 dark:text-gray-200">
                            <a href="{{ route('workouts.show', $workout) }}" class="hover:underline">
                                {{ $workout->name }}
                            </a>
                        </h2>
                        <p class="text-gray-600 dark:text-gray-400">Category: {{ $workout->category }}</p>
                        <p class="text-gray-600 dark:text-gray-400">{{ $workout->description }}</p>
                    </div>
                    @if (auth()->user() && auth()->user()->role === 'admin')
                        <div class="flex gap-2">
                            <a href="{{ route('workouts.edit', $workout) }}" class="text-blue-600 hover:text-blue-800 dark:text-blue-400 dark:hover:text-blue-300">Edit</a>
                            <form method="POST" action="{{ route('workouts.destroy', $workout) }}">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="text-red-600 hover:text-red-800 dark:text-red-400 dark:hover:text-red-300">Delete</button>
                            </form>
                        </div>
                    @endif
                </div>
            </li>
        @endforeach
    </ul>

    <!-- Pagination Links -->
    <div class="mt-4">
        {{ $workouts->links() }}
    </div>

    @if (auth()->user() && auth()->user()->role === 'admin')
        <a href="{{ route('workouts.create') }}" class="mb-4 inline-block bg-green-600 text-white rounded-lg px-4 py-2 hover:bg-green-700">Create New Workout</a>
    @endif

</div>
@endsection
