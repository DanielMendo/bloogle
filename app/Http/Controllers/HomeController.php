<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Post;
use App\Models\User;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {   $categories = Category::all();
        $posts = Post::all();

        return view('dashboard', compact('categories', 'posts'));
    }
}
