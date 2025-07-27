<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Jobs\NotifyFansOfNewPost;

class PostController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'body' => 'required|string',
        ]);

       $author =$request->user();


        $post = Post::create([
            'user_id' => $author->id,
            'title' => $request->title,
            'body' => $request->body,
        ]);

        dispatch(new NotifyFansOfNewPost($post, $author));

        return response()->json([
            'message' => 'Post created successfully, fans will be notified.',
            'post' => $post,
        ]);
    }
}
