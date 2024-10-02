<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CommentController extends Controller
{
    public function store(Request $request, $postId)
    {
        $request->validate([
            'content' => 'required|string|max:1000',
        ]);

        Comment::create([
            'content' => $request->content,
            'post_id' => $postId,
            'user_id' => Auth::id()
        ]);

        return redirect()->back();
    }

    public function destroy($commentId) 
    {
        $comment = Comment::findOrFail($commentId);
        $comment->delete();

        return redirect()->back();
    }
}
