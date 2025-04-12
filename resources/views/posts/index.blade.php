<!-- resources/views/posts/index.blade.php -->
@extends('layouts.app')

@section('title', 'All Posts')

@section('content')
    <h1>Published Posts</h1>
    <form action="{{ route('posts.index') }}" method="GET" class="mb-4">
    <div class="input-group">
        <input type="text" class="form-control" name="search" placeholder="Search posts..." value="{{ request('search') }}">
        <button class="btn btn-outline-secondary" type="submit">Search</button>
    </div>
</form>
    @forelse($posts as $post)
        <div class="card mb-3">
            <div class="card-body">
                <h2 class="card-title">{{ $post->title }}</h2>
                <p class="card-text">{{ Str::limit($post->content, 200) }}</p>
                <a href="{{ route('posts.show', $post) }}" class="btn btn-primary">Read More</a>
                @if(auth()->check())
                    <a href="{{ route('posts.edit', $post) }}" class="btn btn-secondary">Edit</a>
                    <form action="{{ route('posts.destroy', $post) }}" method="POST" class="d-inline">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger">Delete</button>
                    </form>
                    <form action="{{ route('posts.toggle', $post) }}" method="POST" class="d-inline">
                        @csrf
                        <button type="submit" class="btn btn-{{ $post->is_published ? 'warning' : 'success' }}">
                            {{ $post->is_published ? 'Unpublish' : 'Publish' }}
                        </button>
                    </form>
                @endif
            </div>
        </div>
    @empty
        <p>No posts found.</p>
    @endforelse
@endsection