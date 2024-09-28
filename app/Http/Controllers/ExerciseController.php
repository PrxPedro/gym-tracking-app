<?php

namespace App\Http\Controllers;

use App\Models\Exercise;
use App\Models\Workout;
use Illuminate\Http\Request;

class ExerciseController extends Controller
{
    public function create(Workout $workout)
    {
        return view('exercises.create', compact('workout'));
    }

    public function store(Request $request, Workout $workout)
    {
        $request->validate([
            'name' => 'required',
            'sets' => 'required|integer',
            'reps' => 'required|integer',
        ]);

        $workout->exercises()->create($request->all());

        return redirect()->route('workouts.index')->with('success', 'Exercise added to workout.');
    }

    public function destroy(Exercise $exercise)
    {
        $exercise->delete();
        return redirect()->route('workouts.index')->with('success', 'Exercise deleted successfully.');
    }
}
