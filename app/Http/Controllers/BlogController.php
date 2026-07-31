<?php

namespace App\Http\Controllers;

use App\Models\Post;

class BlogController extends Controller
{
    public function index()
    {
        $posts = Post::where('is_published', true)->latest('published_at')->get();
        $categories = $posts->pluck('category')->unique()->sort()->values();

        return view('pages.blog', compact('posts', 'categories'));
    }

    public function show(Post $post)
    {
        abort_unless($post->is_published, 404);

        $related = Post::where('is_published', true)
            ->where('id', '!=', $post->id)
            ->latest('published_at')->take(3)->get();

        return view('pages.blog-show', compact('post', 'related'));
    }
}
