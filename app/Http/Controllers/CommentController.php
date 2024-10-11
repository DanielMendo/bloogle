<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Notifications\NewComment;


class CommentController extends Controller
{
    public function store(Request $request, Post $post)
    {
        $request->validate([
            'content' => 'required|string|max:1000',
            'parent_id' => 'nullable'
        ]);

        Comment::create([
            'content' => $request->content,
            'parent_id' => $request->parent_id,
            'post_id' => $post->id,
            'user_id' => Auth::id()
        ]);

        $post->user->notify(new NewComment(Auth::user(), $post));

        return redirect()->back();
    }

    public function destroy($commentId) 
    {
        $comment = Comment::findOrFail($commentId);
        $comment->delete();

        return redirect()->back();
    }
}
