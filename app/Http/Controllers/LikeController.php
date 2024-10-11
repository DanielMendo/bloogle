<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Notifications\PostLiked;


class LikeController extends Controller
{
    public function store(Request $request, Post $post) 
    {
        $post->likes()->create([
            'user_id' => $request->user()->id
        ]);

        $post->user->notify(new PostLiked(Auth::user(), $post));

        return back();
    }

    public function destroy(Request $request, Post $post)
    {
        $request->user()->likes()->where('post_id', $post->id)->delete();

        return back();
    }
}
