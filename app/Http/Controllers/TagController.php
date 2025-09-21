<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\PostTag;

class TagController extends Controller
{
    public function __construct()
    {
        $this->middleware('can:tags_manage');
    }

    public function index()
    {
        $tags = PostTag::latest()->paginate(20);
        return view('backend.tags.index', compact('tags'));
    }

    public function create()
    {
        return view('backend.tags.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'tag_label' => 'required|string|max:50|unique:post_tags,tag_label',
        ]);

        PostTag::create(['tag_label' => $request->tag_label]);

        return redirect()->route('tags.index')->with('success', 'Tag created successfully.');
    }

    public function edit(PostTag $tag)
    {
        return view('backend.tags.edit', compact('tag'));
    }

    public function update(Request $request, PostTag $tag)
    {
        $request->validate([
            'tag_label' => 'required|string|max:50|unique:post_tags,tag_label,' . $tag->id,
        ]);

        $tag->update(['tag_label' => $request->tag_label]);

        return redirect()->route('tags.index')->with('success', 'Tag updated successfully.');
    }

    public function destroy(PostTag $tag)
    {
        $tag->delete();
        return redirect()->route('tags.index')->with('success', 'Tag deleted successfully.');
    }
}
