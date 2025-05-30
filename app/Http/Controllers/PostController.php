<?php 
namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;

class PostController extends Controller
{
    public function index(Request $request)
{
    $query = Post::where('is_published', true)->latest();
    
    if ($request->has('search')) {
        $query->where('title', 'like', '%' . $request->search . '%')
              ->orWhere('content', 'like', '%' . $request->search . '%');
    }
    
    $posts = $query->get();
    
    return view('posts.index', compact('posts'));
}

    public function create()
    {
        return view('posts.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|max:255',
            'content' => 'required',
            'is_published' => 'sometimes|boolean'
        ]);

        Post::create($validated);

        return redirect()->route('posts.index')->with('success', 'Post created successfully!');
    }

    public function show(Post $post)
    {
        if (!$post->is_published) {
            abort(404);
        }
        
        return view('posts.show', compact('post'));
    }

    public function edit(Post $post)
    {
        return view('posts.edit', compact('post'));
    }

    public function update(Request $request, Post $post)
    {
        $validated = $request->validate([
            'title' => 'required|max:255',
            'content' => 'required',
            'is_published' => 'sometimes|boolean'
        ]);

        $post->update($validated);

        return redirect()->route('posts.index')->with('success', 'Post updated successfully!');
    }

    public function destroy(Post $post)
    {
        $post->delete();
        return redirect()->route('posts.index')->with('success', 'Post deleted successfully!');
    }
    
    public function togglePublish(Post $post)
    {
        $post->update(['is_published' => !$post->is_published]);
        return back()->with('success', 'Post status updated!');
    }
}