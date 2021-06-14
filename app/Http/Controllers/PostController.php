<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\CheckPostRequest;

use App\Models\Post;

class PostController extends Controller
{
    public function index()
    {
        return view('post.index')->with('posts', Post::orderBy('id', 'desc')->paginate(7));
    }

    public function create()
    {
        return view('post.create');
    }

    public function store(CheckPostRequest $cpr)
    {
        $image = request()->image->store('posts');

        $post = new Post();
        $post->title = request()->title;
        $post->description = request()->description;
        $post->content = request()->content;
        $post->image = $image;
        $post->save();

        return redirect()
            ->route('posts.index')
            ->with('message', 'Post created successfully!');
    }

    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        //
    }

    public function update(Request $request, $id)
    {
        //
    }

    public function destroy($id)
    {
        //
    }
}
