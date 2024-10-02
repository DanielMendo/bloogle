<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\User;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $posts = Post::all();

        return view('posts.index', compact('posts'));

    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Post $post)
    {
        $categories = Category::all();
        return view('posts/create', compact('post', 'categories'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required',
            'content' => 'required',
            'image' => 'required',
            'category_id' => 'required'
        ]);

        $post = Post::create([
            'title' => $request->title,
            'content' => $request->content,
            'image' => $request->image,
            'category_id' => $request->category_id,
            'user_id' => Auth::id()
        ]);

        return redirect()->route('post.show', ['user' => Auth::id(), 'post' => $post->id]);
    }

    /**
     * Display the specified resource.
     */
    public function show(User $user, Post $post)
    {
        return view('posts.show', [
            'post' => $post,
            'user' => $user
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Post $post)
    {
        $categories = Category::all();
        return view('posts.edit', compact('categories'), [
            'post' => $post
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Post $post)
    {
        $validatedData = $request->validate([
            'title' => 'required',
            'content' => 'required',
            'image' => 'nullable',
            'category_id' => 'required',
        ]);

        $post->update($validatedData);

        return redirect()->route('post.show', ['user' => $post->user->id, 'post' => $post->id]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($postId)
    {
        $post = Post::findOrFail($postId);
        $post->delete();
        
        return redirect()->route('profile.show', ['user' => Auth::id()]);
    }
}
