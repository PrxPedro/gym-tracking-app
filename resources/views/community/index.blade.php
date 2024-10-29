@extends('layouts.app')

@section('content')
<div class="container mx-auto p-6 text-gray-800 dark:text-gray-200">
    <h1 class="text-4xl font-bold mb-4">Community</h1>

    <!-- Community Post Form -->
    <form method="POST" action="{{ route('community.store') }}" enctype="multipart/form-data" class="mb-6 bg-gray-800 p-4 rounded-lg shadow-md">
        @csrf
        <div class="mb-4">
            <label for="title" class="block text-white">Post Title:</label>
            <input type="text" name="title" class="w-full p-2 border rounded-lg bg-gray-700 text-white" required>
        </div>
        <div class="mb-4">
            <label for="content" class="block text-white">Content:</label>
            <textarea name="content" class="w-full p-2 border rounded-lg bg-gray-700 text-white" required></textarea>
        </div>
        <div class="mb-4">
            <label for="image" class="block text-white">Upload Image:</label>
            <input type="file" name="image" class="w-full p-2 border rounded-lg bg-gray-700 text-white">
        </div>
        <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded-lg">Post</button>
    </form>

    <!-- Display Community Posts -->
    @foreach ($posts as $post)
        <div class="mb-6 p-4 bg-gray-800 rounded-lg shadow-md">
            <h2 class="text-2xl font-semibold text-white">{{ $post->title }}</h2>
            <p class="text-gray-300">{{ $post->content }}</p>
            @if ($post->image)
                <img src="{{ asset('storage/' . $post->image) }}" alt="{{ $post->title }}" class="mt-4 rounded-lg">
            @endif
            <p class="text-sm text-gray-400 mt-2">Posted by {{ $post->user->name }}</p>
        </div>
    @endforeach
</div>
@endsection