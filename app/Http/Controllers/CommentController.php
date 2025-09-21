<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Comment;

class CommentController extends Controller
{
    // Add middleware if want permission control. Here no approval, open for authenticated users
    public function __construct()
    {
        $this->middleware('auth'); // Require login
        $this->middleware('can:comments_manage'); // Uncomment if admin approval needed
    }

    public function index()
    {
        $comments = Comment::with('user', 'replies')->paginate(20);
        return view('backend.comments.index', compact('comments'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'post_id' => 'required|exists:posts,id',
            'comment_text' => 'required|string',
            'parent_comment_id' => 'nullable|exists:comments,id',
        ]);

        Comment::create([
            'post_id' => $request->post_id,
            'user_id' => auth()->id(),
            'comment_text' => $request->comment_text,
            'parent_comment_id' => $request->parent_comment_id,
        ]);

        return redirect()->back()->with('success', 'Comment posted successfully!');
    }
}
