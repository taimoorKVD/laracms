<?php

namespace App\Http\Controllers;

use App\Http\Requests\CheckTagRequest;

use Illuminate\Http\Request;

use App\Models\Tag;

class TagController extends Controller
{
    public function index()
    {
        return view('tag.index')->with('tags', Tag::orderBy('id','desc')->paginate(7));
    }

    public function create()
    {
        return view('tag.create');
    }

    public function store(CheckTagRequest $ctr)
    {
        $tag = new Tag();
        $tag->name = request()->name;
        $tag->save();

        return redirect()
            ->route('tags.index')
            ->with('message', 'Tag created successfully!');
    }

    public function show($id)
    {
        //
    }

    public function edit(Tag $tag)
    {
        return view('tag.create')->with('tag', $tag);
    }

    public function update(CheckTagRequest $ctr, Tag $tag)
    {
        $tag->name = request()->name;
        $tag->save();

        return redirect()
            ->route('tags.index')
            ->with('message', 'Tag updated successfully!');
    }

    public function destroy(Tag $tag)
    {
        if($tag->posts->count() > 0)
            return redirect()
                ->back()
                ->with('error-message', 'Tag cannot be deleted, because it is associated to some posts.');

        $tag->delete();
        
        return redirect()
            ->back()
            ->with('message', 'Tag deleted successfully');
    }
}
