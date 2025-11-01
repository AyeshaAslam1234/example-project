<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;
use App\Jobs\SendPostNotification;

class PostController extends Controller
{
    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string',
            'body'  => 'nullable|string',
        ]);

        // Create post
        $post = Post::create($validated);

        // Dispatch notification job
        SendPostNotification::dispatch($post->title);

        return response()->json([
            'message' => 'Post created successfully! Notification has been queued.',
            'post' => $post,
        ]);
    }

    public function index()
{
    $posts = Post::latest()->get();

    return response()->json($posts);
}

}
