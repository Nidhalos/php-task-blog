<!-- resources/views/posts/show.blade.php -->
@extends('layouts.app')

@section('title', $post->title)

@section('content')
    <article>
        <h1>{{ $post->title }}</h1>
        <p>Published: {{ $post->created_at->diffForHumans() }}</p>
        <div>{{ $post->content }}</div>
        
        @if(auth()->check())
            <div class="mt-3">
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
            </div>
        @endif
        
        <section class="mt-5">
            <h2>Comments</h2>
            
            @forelse($post->comments as $comment)
                <div class="card mb-2">
                    <div class="card-body">
                        <h5 class="card-title">{{ $comment->name }}</h5>
                        <p class="card-text">{{ $comment->comment }}</p>
                        <small class="text-muted">{{ $comment->created_at->diffForHumans() }}</small>
                    </div>
                </div>
            @empty
                <p>No comments yet.</p>
            @endforelse
        </section>
    </article>
@endsection