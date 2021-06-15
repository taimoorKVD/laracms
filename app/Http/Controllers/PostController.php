<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
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
        $post->published_at = request()->published_at;
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

    public function edit(Post $post)
    {
        return view('post.create')->withPost($post);
    }

    public function update(CheckPostRequest $cpr, Post $post)
    {
        $data = request()->only('title', 'description', 'content', 'published');

        if(request()->hasFile('image'))

            // store new image //
            $image = request()->image->store('posts');

            //delete old image
            $post->deleteImage();

        // add image path to above data array
        $data['image'] = $image;

        // update post data into database
        $post->update($data);

        return redirect()
            ->route('posts.index')
            ->with('message', 'Post updated successfuly');

    }

    public function destroy($id)
    {
        $post = Post::withTrashed()->findOrFail($id);
        $msg = $post->trashed() ? 'Post deleted successfully!' : 'Post trashed successfully!';
        if($post->trashed())
        {
            $post->deleteImage();
            $post->forceDelete();
        }
        else
        {
            $post->delete();
        }
        return redirect()
            ->route('posts.index')
            ->with('message', $msg);
    }

    public function trashed()
    {
        return view('post.index')
            ->withPosts(Post::onlyTrashed()->orderBy('deleted_at','desc')->paginate(7));
    }

    public function restore($id)
    {
        $post = Post::withTrashed()->findOrFail($id);
        $post->restore();
        return redirect()
            ->back()
            ->with('message', 'Post restored successfully!');
    }
}
