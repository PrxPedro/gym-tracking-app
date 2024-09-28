@extends('layouts.app')

@section('content')
    <h1>Edit Workout</h1>

    <form method="POST" action="{{ route('workouts.update', $workout) }}">
        @csrf
        @method('PUT')
        <label>Name:</label>
        <input type="text" name="name" value="{{ $workout->name }}" required>
        <label>Category:</label>
        <select name="category" required>
            <option value="Push" {{ $workout->category == 'Push' ? 'selected' : '' }}>Push</option>
            <option value="Pull" {{ $workout->category == 'Pull' ? 'selected' : '' }}>Pull</option>
            <option value="Legs" {{ $workout->category == 'Legs' ? 'selected' : '' }}>Legs</option>
        </select>
        <label>Description:</label>
        <textarea name="description">{{ $workout->description }}</textarea>
        <button type="submit">Update</button>
    </form>
@endsection
