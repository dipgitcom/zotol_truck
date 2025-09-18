<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Str;

class CategoryController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');

        // Permission middleware
        $this->middleware('can:category_view')->only(['index', 'show']);
        $this->middleware('can:category_create')->only(['create', 'store']);
        $this->middleware('can:category_edit')->only(['edit', 'update']);
        $this->middleware('can:category_delete')->only(['destroy']);
    }

    // List categories with AJAX DataTable
    public function index(Request $request)
{
    if ($request->ajax()) {
        $categories = Category::query();

        return DataTables::of($categories)
            ->addIndexColumn() // This adds DT_RowIndex
            ->addColumn('image', function ($row) {
                return $row->image
                    ? '<img src="' . asset($row->image) . '" width="50" height="50" class="rounded">'
                    : '<span class="badge bg-secondary">No Image</span>';
            })
            ->addColumn('status', function ($row) {
                return $row->status
                    ? '<span class="badge bg-success">Active</span>'
                    : '<span class="badge bg-secondary">Inactive</span>';
            })
            ->addColumn('action', function ($row) {
                $buttons = '';
                if (auth()->user()->can('category_edit')) {
                    $buttons .= '<a href="' . route('categories.edit', $row->id) . '" class="btn btn-sm btn-primary me-1">
                                    <i class="bi bi-pencil-square"></i> Edit
                                 </a>';
                }
                if (auth()->user()->can('category_delete')) {
                    $buttons .= '<form action="' . route('categories.destroy', $row->id) . '" method="POST" style="display:inline-block;">
                                    ' . csrf_field() . method_field('DELETE') . '
                                    <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm(\'Are you sure?\')">
                                        <i class="bi bi-trash"></i> Delete
                                    </button>
                                 </form>';
                }
                return $buttons;
            })
            ->rawColumns(['image', 'status', 'action'])
            // IMPORTANT: prevent DT_RowIndex from being searched or ordered
            ->filterColumn('DT_RowIndex', function($query, $keyword) {
                // do nothing
            })
            ->orderColumn('DT_RowIndex', function($query, $order) {
                // default ordering by ID or created_at instead
                $query->orderBy('id', $order);
            })
            ->make(true);
    }

    return view('backend.categories.index');
}
    // Show create form
    public function create()
    {
        return view('backend.categories.create');
    }

    // Store category
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'slug' => 'nullable|string|max:255|unique:categories,slug',
            'image' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        $slug = $request->slug ?? Str::slug($request->name);
        $status = $request->has('status') ? 1 : 0;

        $data = $request->only('name');
        $data['slug'] = $slug;
        $data['status'] = $status;

        if ($request->hasFile('image')) {
            $path = $request->file('image')->store('uploads/categories', 'public');
            $data['image'] = 'storage/' . $path;
        }

        Category::create($data);

        return redirect()->route('categories.index')->with('success', 'Category created successfully.');
    }

    // Show edit form
    public function edit(Category $category)
    {
        return view('backend.categories.edit', compact('category'));
    }

    // Update category
    public function update(Request $request, Category $category)
    {
        $request->validate([
            'name' => 'required|string|max:255|unique:categories,name,' . $category->id,
            'slug' => 'nullable|string|max:255|unique:categories,slug,' . $category->id,
            'description' => 'nullable|string',
            'image' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
            'status' => 'nullable|boolean',
        ]);

        $slug = $request->slug ?? Str::slug($request->name);

        $data = $request->only(['name', 'description']);
        $data['slug'] = $slug;
        $data['status'] = $request->has('status') ? 1 : 0;

        if ($request->hasFile('image')) {
            if ($category->image && file_exists(public_path($category->image))) {
                unlink(public_path($category->image));
            }
            $path = $request->file('image')->store('uploads/categories', 'public');
            $data['image'] = 'storage/' . $path;
        }

        $category->update($data);

        return redirect()->route('categories.index')->with('success', 'Category updated successfully.');
    }

    // Delete category
    public function destroy(Category $category)
    {
        if ($category->image && file_exists(public_path($category->image))) {
            unlink(public_path($category->image));
        }

        $category->delete();

        return redirect()->route('categories.index')->with('success', 'Category deleted successfully.');
    }
}
