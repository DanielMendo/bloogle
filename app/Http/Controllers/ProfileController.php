<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProfileController extends Controller
{
    public function show(User $user)
    {   
        $posts = Post::where('user_id', $user->id)->get();

        return view('profile.about', [
            'user' => $user,
            'posts' => $posts
        ]);
    }

    public function edit(User $user) 
    {
        return view('profile.edit', [
            'user' => $user
        ]);
    }

    public function update(Request $request, User $user)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'slug' => 'nullable|string|max:255',
            'bio' => 'nullable|string',
            'facebook' => 'nullable|string|max:255',
            'twitter' => 'nullable|string|max:255',
            'instagram' => 'nullable|string|max:255',
            'profile_picture' => 'nullable',
        ]);

        $user->update($validatedData);

        return redirect()->route('profile.show', $user->slug);
    }

}
