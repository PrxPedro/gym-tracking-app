<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Message;
use App\Models\Post;
use Illuminate\Support\Facades\Auth;
use App\Notifications\MessageReceivedNotification;
class MessageController extends Controller
{
    // User's Messages
    public function userMessages()
    {
        $messages = Message::where('recipient_id', Auth::id())->with('post', 'sender')->get();
        return view('community.messages', compact('messages'));
    }

    public function index()
{
    $user = auth()->user();

    // Fetch all messages linked to the posts owned by the user
    $messages = \App\Models\Message::whereHas('post', function ($query) use ($user) {
        $query->where('user_id', $user->id);
    })->with(['sender', 'post'])->latest()->get();

    return view('messages.index', compact('messages'));
}
        
    // Admin's Messages Management
    public function adminMessages()
    {
        $messages = Message::with('post', 'sender', 'recipient')->get();

        return view('admin.messages', compact('messages'));
    }

    // Edit a Message
    public function editMessage($id)
    {
        $message = Message::findOrFail($id);

        return view('admin.edit-message', compact('message'));
    }

    // Update a Message
    public function updateMessage(Request $request, $id)
    {
        $message = Message::findOrFail($id);
        $message->content = $request->input('content');
        $message->save();

        return redirect()->route('admin.messages')->with('success', 'Message updated successfully!');
    }

    // Delete a Message
    public function deleteMessage($id)
    {
        $message = Message::findOrFail($id);
        $message->delete();

        return redirect()->back()->with('success', 'Message deleted successfully!');
    }

    public function store(Request $request, Post $post)
{
    // Validate the content
    $request->validate(['content' => 'required']);

    // Create the comment message
    $message = Message::create([
        'content' => $request->content,
        'sender_id' => auth()->id(), // Current logged-in user
        'recipient_id' => $post->user_id, // The post's author
        'post_id' => $post->id, // Related post ID
    ]);

    // Create a notification for the post author (if it's not the sender)
    if ($post->user_id !== auth()->id()) {
        $recipient = $post->user; // Fetch recipient of the message
        $recipient->notify(new MessageReceivedNotification($message));
    }

    return back()->with('success', 'Comment added successfully.');
}
}
