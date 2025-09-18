<?php

namespace App\Http\Controllers;

use App\Models\DynamicPage;
use Illuminate\Http\Request;

class DynamicPageController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');

        // Permission middleware
        $this->middleware('can:dynamic_view')->only(['index', 'show']);
        $this->middleware('can:dynamic_create')->only(['create', 'store']);
        $this->middleware('can:dynamic_edit')->only(['edit', 'update']);
        $this->middleware('can:dynamic_delete')->only(['destroy']);
    }

    public function index()
    {
        $pages = DynamicPage::latest()->get();
        return view('backend.layouts.dynamic.index', compact('pages'));
    }

    public function create()
    {
        return view('backend.layouts.dynamic.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title'   => 'required|string|max:255',
            'slug'    => 'required|string|max:255|unique:dynamic_pages,slug',
            'content' => 'nullable|string',
        ]);

        DynamicPage::create($request->only(['title', 'slug', 'content']));

        return redirect()->route('dynamic.index')
                         ->with('success', 'Dynamic page created successfully!');
    }

    public function show(DynamicPage $dynamic)
    {
        return view('backend.layouts.dynamic.show', compact('dynamic'));
    }

    public function edit(DynamicPage $dynamic)
    {
        return view('backend.layouts.dynamic.edit', compact('dynamic'));
    }

    public function update(Request $request, DynamicPage $dynamic)
    {
        $request->validate([
            'title'   => 'required|string|max:255',
            'slug'    => 'required|string|max:255|unique:dynamic_pages,slug,' . $dynamic->id,
            'content' => 'nullable|string',
        ]);

        $dynamic->update($request->only(['title', 'slug', 'content']));

        return redirect()->route('dynamic.index')
                         ->with('success', 'Dynamic page updated successfully!');
    }

    public function destroy(DynamicPage $dynamic)
    {
        $dynamic->delete();

        return redirect()->route('dynamic.index')
                         ->with('success', 'Dynamic page deleted successfully!');
    }
}
