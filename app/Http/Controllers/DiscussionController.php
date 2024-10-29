<?php

namespace App\Http\Controllers;

use App\Models\Forum;
use App\Models\Discussion;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DiscussionController extends Controller
{
    // Store a new discussion in the specified forum
    public function store(Request $request, Forum $forum)
{
    $request->validate([
        'content' => 'required|min:5',
    ]);

    $forum->discussions()->create([
        'user_id' => auth()->id(),
        'content' => $request->input('content'),
    ]);

    return redirect()->route('forums.show', $forum)->with('success', 'Discussion added successfully.');
}

}
