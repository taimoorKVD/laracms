<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Tag;
use App\Models\Post;

use Illuminate\Http\Request;

class WelcomeController extends Controller
{
    public function index()
    {
        $search = request()->query('search');
        $posts = $search 
            ? Post::where('title', 'LIKE', "%{$search}%")->simplePaginate(1)
            : Post::simplePaginate(10);
        
        return view('frontend.layouts.web')
        ->withCategories(Category::all())
        ->withTags(Tag::all())
        ->withPosts($posts);
    }

    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        //
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
