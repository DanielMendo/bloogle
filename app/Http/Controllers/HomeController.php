<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Post;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {   $categories = Category::all();
        $posts = Post::all();

        return view('index', compact('categories', 'posts'));
    }
}
