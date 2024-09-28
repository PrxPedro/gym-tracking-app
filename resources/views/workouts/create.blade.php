@extends('layouts.app')

@section('content')
    <h1>Create Workout</h1>

    <form method="POST" action="{{ route('workouts.store') }}">
        @csrf
        <label>Name:</label>
        <input type="text" name="name" required>
        <label>Category:</label>
        <select name="category" required>
            <option value="Push">Push</option>
            <option value="Pull">Pull</option>
            <option value="Legs">Legs</option>
        </select>
        <label>Description:</label>
        <textarea name="description"></textarea>
        <button type="submit">Create</button>
    </form>
@endsection
