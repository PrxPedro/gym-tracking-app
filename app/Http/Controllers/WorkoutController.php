<?php

namespace App\Http\Controllers;
use App\Models\Rating; 
use App\Models\Workout;
use Illuminate\Http\Request;
use App\Models\Exercise;

class WorkoutController extends Controller
{
    public function index(Request $request)
    {
        $query = Workout::query();

        // Advanced search/filter options
        if ($request->filled('search')) {
            $query->where('name', 'like', '%' . $request->input('search') . '%');
        }

        if ($request->filled('category')) {
            $query->where('category', $request->input('category'));
        }

        if ($request->filled('difficulty')) {
            $query->where('difficulty', $request->input('difficulty'));
        }

        // Pagination
        $workouts = $query->paginate(10);

        return view('workouts.index', compact('workouts'));
    }

    public function create() {
        return view('workouts.create'); // Return the view for creating a workout
    }
    
    public function show(Workout $workout)
        {
            $workout->load(['ratings', 'exercises']);
            return view('workouts.show', compact('workout'));
        }


        public function store(Request $request)
        {
            $request->validate([
                'name' => 'required|string|max:255',
                'category' => 'required|string|max:255',
                'description' => 'nullable|string',
                'difficulty' => 'required|string|in:Easy,Medium,Hard',
            ]);
    
            Workout::create([
                'name' => $request->name,
                'category' => $request->category,
                'description' => $request->description,
                'difficulty' => $request->difficulty,
            ]);
    
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

    public function rate(Request $request, Workout $workout)
{
    $request->validate([
        'rating' => 'required|integer|between:1,5', // Validate rating between 1 and 5
    ]);

    Rating::create([
        'workout_id' => $workout->id,
        'rating' => $request->input('rating'),
    ]);

    return redirect()->route('workouts.show', $workout)->with('success', 'Rating submitted successfully.');
}

public function updateSets(Request $request, Workout $workout)
{
    foreach ($request->input('sets', []) as $exerciseId => $sets) {
        $exercise = Exercise::find($exerciseId);
        if ($exercise) {
            $exercise->update([
                'set_1' => $sets['set_1'] ?? $exercise->set_1,
                'set_2' => $sets['set_2'] ?? $exercise->set_2,
                'set_3' => $sets['set_3'] ?? $exercise->set_3,
            ]);
        }
    }
    return back()->with('success', 'Sets updated successfully.');
}


}
