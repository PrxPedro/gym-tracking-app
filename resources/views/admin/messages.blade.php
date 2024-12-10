@extends('layouts.app')

@section('title', 'Manage Messages')

@section('content')
<div class="container py-5 mx-auto px-4 lg:px-8">
    <h1 class="text-white text-3xl font-bold mb-6 text-center">Manage Messages</h1>
    <div class="space-y-6">
        @forelse ($messages as $message)
            <div class="p-6 bg-gray-800 rounded shadow hover:bg-gray-700 transition duration-200 flex justify-between items-center">
                <div>
                    <p class="text-white font-semibold">{{ $message->content }}</p>
                    <small class="text-gray-400 block mt-2">
                        From: 
                        <strong class="text-blue-400">{{ $message->sender ? $message->sender->name : 'Unknown Sender' }}</strong> 
                        | To: 
                        <strong class="text-blue-400">{{ $message->recipient ? $message->recipient->name : 'Unknown Recipient' }}</strong>
                        | On Post: 
                        @if ($message->post)
                            <a href="{{ route('community.show', $message->post->id) }}" class="text-blue-400 hover:underline">
                                {{ $message->post->title }}
                            </a>
                        @else
                            <span class="text-gray-400">Post not found</span>
                        @endif
                    </small>
                </div>
                <div class="mt-2 space-x-3">
                        @csrf
                        @method('DELETE')
                        <button type="submit" 
                                class="px-4 py-2 bg-red-500 text-white rounded hover:bg-red-600 transition duration-200">Delete</button>
                    </form>
                </div>
            </div>
        @empty
            <p class="text-gray-400 text-center">No messages available.</p>
        @endforelse
    </div>
</div>
@endsection
