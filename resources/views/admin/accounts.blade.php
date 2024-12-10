@extends('layouts.app')

@section('title', 'Manage Accounts')

@section('content')
<div class="container mx-auto px-4 lg:px-8 py-8">
    <!-- Page Title -->
    <h1 class="text-white text-3xl font-bold text-center mb-6">Manage User Accounts</h1>

    <!-- User Accounts Table -->
    <div class="bg-gray-800 p-6 rounded-lg shadow-lg">
        <table class="w-full text-left table-auto border-collapse border border-gray-700">
            <thead>
                <tr class="bg-gray-700">
                    <th class="px-4 py-2 text-gray-300 border border-gray-600">Name</th>
                    <th class="px-4 py-2 text-gray-300 border border-gray-600">Email</th>
                    <th class="px-4 py-2 text-gray-300 border border-gray-600">Role</th>
                    <th class="px-4 py-2 text-gray-300 border border-gray-600">Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($users as $user)
                    <tr class="hover:bg-gray-700 transition duration-150">
                        <td class="px-4 py-2 text-white border border-gray-600">{{ $user->name }}</td>
                        <td class="px-4 py-2 text-white border border-gray-600">{{ $user->email }}</td>
                        <td class="px-4 py-2 text-white border border-gray-600">{{ ucfirst($user->role) }}</td>
                        <td class="px-4 py-2 text-white border border-gray-600">
                            <!-- Edit Button -->
                            <a href="{{ route('admin.accounts.edit', $user->id) }}" 
                               class="px-3 py-1 bg-yellow-500 text-white rounded hover:bg-yellow-600 transition duration-150">
                               Edit
                            </a>
                            <!-- Ban Button -->
                            <form action="{{ route('admin.accounts.ban', $user->id) }}" method="POST" style="display:inline;">
                                @csrf
                                <button type="submit" 
                                        class="px-3 py-1 bg-red-500 text-white rounded hover:bg-red-600 transition duration-150">
                                    Ban
                                </button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="4" class="px-4 py-2 text-gray-300 text-center border border-gray-600">No users found.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection
