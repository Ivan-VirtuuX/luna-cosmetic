<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;

class PostController extends Controller
{
    public function posts()
    {
        $posts = Post::all();

        return view("post.index", compact("posts"));
    }

    public function create()
    {
        return view("post.create");
    }

    public function store(Request $request)
    {
        $request->validate([
            'author' => 'required|string',
            'text' => 'required|string'
        ]);

        $newRequest = new Post([
            'author' => $request->author,
            'text' => $request->text,
            'likes_count' => 0
        ]);
        $newRequest->save();

        return redirect()->route("post.index");
    }

    public function show(Post $post)
    {
        return view("post.show", compact("post"));
    }

    public function edit(Post $post)
    {
        return view("post.edit", compact("post"));
    }

    public function update(Post $post)
    {
        $data = request()->validate([
            'author' => 'required|string',
            'text' => 'required|string'
        ]);

        $post->update($data);

        return redirect()->route('post.show', $post->id);
    }

    public function destroy(Post $post)
    {
        $post->delete();

        return redirect()->route('post.index');
    }
}
