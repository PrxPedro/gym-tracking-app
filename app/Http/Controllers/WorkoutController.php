<?php

namespace App\Http\Controllers;

use App\Models\Workout;
use Illuminate\Http\Request;

class WorkoutController extends Controller
{
    public function index() {
        $workouts = Workout::all(); // Fetch all workouts
        return view('workouts.index', compact('workouts')); // Pass workouts to the view
    }

    public function create() {
        return view('workouts.create'); // Return the view for creating a workout
    }
    
    public function show(Workout $workout)
    {
        return view('workouts.show', compact('workout'));
    }
    public function store(Request $request) {
        // Validate and store the workout
        $request->validate([
            'name' => 'required',
            'category' => 'required',
            'description' => 'nullable',
        ]);
        
        Workout::create($request->all());
        return redirect()->route('workouts.index')->with('success', 'Workout created successfully.');
    }

    public function edit(Workout $workout)
    {
        return view('workouts.edit', compact('workout'));
    }

    public function update(Request $request, Workout $workout)
    {
        $request->validate([
            'name' => 'required',
            'category' => 'required',
        ]);

        $workout->update($request->all());

        return redirect()->route('workouts.index')->with('success', 'Workout updated successfully.');
    }

    public function destroy(Workout $workout)
    {
        $workout->delete();
        return redirect()->route('workouts.index')->with('success', 'Workout deleted successfully.');
    }
}
