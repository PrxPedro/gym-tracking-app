@extends('layouts.app')

@section('content')
<div class="container mx-auto p-6 text-gray-800 dark:text-gray-200">
    <div class="bg-gray-800 p-6 rounded-lg shadow-md">
        <h1 class="text-4xl font-bold mb-4 text-white">{{ $post->title }}</h1>
        <p class="text-gray-300 mb-6">{{ $post->content }}</p>
        @if ($post->image)
            <img src="{{ asset('storage/' . $post->image) }}" alt="{{ $post->title }}" class="rounded-lg mb-6">
        @endif
        <p class="text-sm text-gray-400 mb-4">
            Posted by 
            <a href="{{ route('profile.show', ['user' => $post->user->id]) }}" class="text-blue-400 hover:underline">
                {{ $post->user->name }}
            </a>
        </p>

        <!-- Comments Section -->
        <div class="mt-6">
            <h2 class="text-2xl font-semibold text-white mb-4">Comments</h2>

            <!-- Comment Form -->
            @auth
                <form method="POST" action="{{ route('messages.store', ['post' => $post->id]) }}" class="mb-4">
                    @csrf
                    <textarea name="content" placeholder="Write your comment..." rows="3" required 
                              class="w-full rounded-lg border border-gray-700 bg-gray-900 text-gray-200 p-4 focus:ring focus:ring-blue-500"></textarea>
                    <button type="submit" 
                            class="mt-2 bg-blue-600 text-white px-4 py-2 rounded-lg hover:bg-blue-700">
                        Comment
                    </button>
                </form>
            @else
                <div class="bg-gray-700 p-4 rounded-lg text-center">
                    <p class="text-gray-400">
                        Please 
                        <a href="{{ route('login') }}" class="text-blue-400 hover:underline">
                            log in
                        </a> 
                        to comment.
                    </p>
                </div>
            @endauth

            <!-- List of Comments -->
            @if ($post->messages->isEmpty())
                <p class="text-gray-400">No comments yet. Be the first to comment!</p>
            @else
                <ul class="space-y-4">
                @foreach ($post->messages as $message)
                    <li class="bg-gray-700 p-4 rounded-lg">
                        <p class="text-sm text-gray-400">
                            Posted by 
                            @if ($message->user)
                                <a href="{{ route('profile.show', ['user' => $message->user->id]) }}" 
                                class="text-blue-400 hover:underline">
                                    {{ $message->user->name }}
                                </a>
                            @else
                                <span class="text-red-400">Unknown User</span>
                            @endif
                        </p>
                        <p class="text-gray-200 mt-2">{{ $message->content }}</p>
                    </li>
                @endforeach

                </ul>
            @endif
        </div>
    </div>
</div>
@endsection
