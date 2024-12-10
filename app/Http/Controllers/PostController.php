<?php
namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;

class PostController extends Controller
{
    // Show all community posts
    public function index()
    {
        $posts = Post::latest()->paginate(10);
        return view('community.index', compact('posts'));
    }

    // Show a specific post
    public function show(Post $post)
    {
        return view('community.show', compact('post'));
    }

    // Store a new community post
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|max:255',
            'content' => 'required',
            'image' => 'nullable|image|max:2048', // Validate image upload
        ]);

        // Handle image upload
        $imagePath = null;
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('posts', 'public');
        }

        // Create the post
        Post::create([
            'user_id' => auth()->id(),
            'title' => $request->title,
            'content' => $request->content,
            'image' => $imagePath, // Save the image path
        ]);

        return redirect()->route('community.index')->with('success', 'Post created successfully.');
    }

public function storeComment(Request $request, $postId)
{
    // Validate the input
    $request->validate([
        'content' => 'required|string|max:500',
    ]);

    // Retrieve the post being commented on
    $post = Post::findOrFail($postId);

    // Ensure `recipient_id` is the post author's user ID
    $recipientId = $post->user_id;

    // Create the actual comment (message)
    $comment = Message::create([
        'content' => $request->input('content'),
        'sender_id' => auth()->id(), // Logged-in user
        'recipient_id' => $recipientId, // Post author
        'post_id' => $postId, // Related post
    ]);

     // Add a notification for the recipient
    $recipient = $post->user;
    if ($recipient && $recipient->id !== auth()->id()) { // Avoid notifying the sender
        $recipient->notifications()->create([
            'content' => "New comment on your post: {$post->title}",
            'url' => route('community.messages'), // Redirects to the messages page
        ]);
    }

    return back()->with('success', 'Comment added successfully.');
}
    

    
            
    
    // Show community messages
    public function messages()
    {
        $messages = Post::latest()->get();
        return view('community.messages', compact('messages'));
    }
}
