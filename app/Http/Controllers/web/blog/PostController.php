<?php

namespace App\Http\Controllers\web\blog;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Post;
use App\Models\Category;
use App\Models\Tag;

class PostController extends Controller
{
    public function index()
    {
        return view('frontend.layouts.web')
        ->withCategories(Category::all())
        ->withTags(Tag::all())
        ->withPosts(Post::searched()->simplePaginate(10));
    }

    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        //
    }

    public function show(Post $post)
    {
        return view('frontend.blog.show')
            ->withPost($post);
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

    public function category(Category $category)
    {
        return view('frontend.blog.category')
        ->withCategory($category)
        ->withCategories(Category::all())
        ->withTags(Tag::all())
        ->withPosts($category->posts()->searched()->simplePaginate(10));        
    }

    public function tag(Tag $tag)
    {
        return view('frontend.blog.tag')
        ->withTag($tag)
        ->withCategories(Category::all())
        ->withTags(Tag::all())
        ->withPosts($tag->posts()->searched()->simplePaginate(10));        
    }
}
