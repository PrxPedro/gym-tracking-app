@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4 lg:px-8 py-5">
    <div class="max-w-4xl mx-auto">
        <h1 class="text-white text-4xl font-bold mb-6 text-center">My Messages</h1>

        @if ($messages->isEmpty())
            <div class="flex justify-center items-center h-40 bg-gray-800 rounded shadow-md">
                <p class="text-gray-400 text-lg">No messages available.</p>
            </div>
        @else
            <div class="space-y-4">
                @foreach ($messages as $message)
                    <a href="{{ $message->post ? route('community.show', $message->post->id) : 'javascript:alert(\'Post not found.\')' }}" 
                       class="block p-4 bg-gray-800 rounded shadow-md hover:bg-gray-700 transition duration-200">
                        <p class="text-white font-semibold text-lg">{{ $message->content }}</p>
                        <div class="text-gray-400 text-sm mt-2">
                            @if ($message->sender)
                                <span>From: 
                                    <strong class="text-blue-400">{{ $message->sender->name }}</strong>
                                </span>
                            @else
                                <span class="text-gray-400">Sender unknown</span>
                            @endif

                            @if ($message->post)
                                | <span>On Post: {{ $message->post->title }}</span>
                            @else
                                | <span class="text-gray-400">Post not found</span>
                            @endif
                        </div>
                    </a>
                @endforeach
            </div>
        @endif
    </div>
</div>
@endsection
