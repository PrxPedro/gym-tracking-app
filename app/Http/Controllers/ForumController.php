<?php

namespace App\Http\Controllers;

use App\Models\Forum;
use Illuminate\Http\Request;

class ForumController extends Controller
{
    // Show a list of all forums
    public function index()
    {
        $forums = Forum::withCount('discussions')->get();
        return view('forums.index', compact('forums'));
    }

    // Show details of a specific forum with its discussions
    public function show(Forum $forum)
    {
        $forum->load('discussions.user'); // Eager load discussions and associated users
        return view('forums.show', compact('forum'));
    }
}
