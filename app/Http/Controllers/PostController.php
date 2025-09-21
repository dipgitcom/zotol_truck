<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;

class PostController extends Controller
{
    public function __construct()
    {
        
        $this->middleware('auth');
        $this->middleware('can:posts_manage')->only(['create', 'store', 'edit', 'update', 'destroy']);

    }

    public function index()
{
    $posts = Post::with(['tags', 'media', 'location'])->latest()->paginate(15);
    return view('backend.posts.index', compact('posts'));
}

    public function create()
    {
        return view('backend.posts.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'post_type' => 'required|in:incident,daily',
            'tags' => 'nullable|array',
            'tags.*' => 'string|max:50',
            'photo' => 'nullable|array',
            'photo.*' => 'file|mimes:jpg,jpeg,png,mp4,mov|max:10240',
            'location_name' => 'nullable|string|max:255',
            'latitude' => 'nullable|numeric',
            'longitude' => 'nullable|numeric',
            'distance' => 'nullable|string',
            'incident_area' => 'nullable|string',
        ]);

        $post = Post::create([
            'user_id' => auth()->id(),
            'title' => $request->title,
            'description' => $request->description,
            'post_type' => $request->post_type,
        ]);

        // Tags
        if ($request->tags) {
            foreach ($request->tags as $tag) {
                $post->tags()->create(['tag_label' => $tag]);
            }
        }

        // Location
        if ($request->location_name) {
            $post->location()->create([
                'location_name' => $request->location_name,
                'latitude' => $request->latitude,
                'longitude' => $request->longitude,
                'distance' => $request->distance,
            ]);
        }

        // Media
        if ($request->hasFile('photo')) {
            foreach ($request->file('photo') as $media) {
                $path = $media->store('post_media', 'public');
                $post->media()->create([
                    'media_url' => $path,
                    'media_type' => $media->getClientMimeType(),
                ]);
            }
        }

        // Incident area
        if ($request->incident_area) {
            $post->incident_area = $request->incident_area;
            $post->save();
        }

        return redirect()->route('posts.index')->with('success', 'Post created successfully');
    }

    // Add other resource methods (index, edit, update, destroy) as needed
}
