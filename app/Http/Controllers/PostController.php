<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;
use App\Models\Tag;
use App\Models\PostMedia;

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
            'incident_area' => $request->incident_area,
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

        return redirect()->route('posts.index')->with('success', 'Post created successfully.');
    }

    public function edit($id)
    {
        $post = Post::with(['tags', 'media', 'location'])->findOrFail($id);
        return view('backend.posts.edit', compact('post'));
    }

    public function update(Request $request, $id)
    {
        $post = Post::with(['tags', 'media', 'location'])->findOrFail($id);

        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'post_type' => 'required|in:incident,daily',
            'tags' => 'nullable|string',
            'photo.*' => 'nullable|mimes:jpg,jpeg,png,mp4,mov|max:20480',
            'location_name' => 'nullable|string|max:255',
            'latitude' => 'nullable|numeric',
            'longitude' => 'nullable|numeric',
            'distance' => 'nullable|string',
            'incident_area' => 'nullable|string|max:255',
        ]);

        // Update main post
        $post->update([
            'title' => $request->title,
            'description' => $request->description,
            'post_type' => $request->post_type,
            'incident_area' => $request->incident_area,
        ]);

        // Update location
        if ($request->location_name) {
            $post->location()->updateOrCreate(
                ['post_id' => $post->id],
                [
                    'location_name' => $request->location_name,
                    'latitude' => $request->latitude,
                    'longitude' => $request->longitude,
                    'distance' => $request->distance,
                ]
            );
        } else {
            $post->location()->delete();
        }

        // Update tags
        if ($request->tags) {
            $tagLabels = array_map('trim', explode(',', $request->tags));
            $tagIds = [];
            foreach ($tagLabels as $label) {
                if ($label) {
                    $tag = Tag::firstOrCreate(['tag_label' => $label]);
                    $tagIds[] = $tag->id;
                }
            }
            $post->tags()->sync($tagIds);
        } else {
            $post->tags()->detach();
        }

        // Handle new media uploads
        if ($request->hasFile('photo')) {
            foreach ($request->file('photo') as $file) {
                $path = $file->store('post_media', 'public');
                $post->media()->create([
                    'media_url' => $path,
                    'media_type' => $file->getClientMimeType(),
                ]);
            }
        }

        return redirect()->route('posts.index')->with('success', 'Post updated successfully.');
    }

    public function destroy($id)
    {
        $post = Post::findOrFail($id);
        $post->delete();
        return redirect()->route('posts.index')->with('success', 'Post deleted successfully.');
    }

    // Optional: Delete single media
    public function destroyMedia($id)
    {
        $media = PostMedia::findOrFail($id);
        $media->delete();
        return back()->with('success', 'Media deleted successfully.');
    }

    public function show($id)
    {
        abort(404);
    }
}
