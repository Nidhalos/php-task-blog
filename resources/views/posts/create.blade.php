<!-- resources/views/posts/create.blade.php -->
@extends('layouts.app')

@section('title', 'Create Post')

@section('content')
    <h1>Create New Post</h1>
    
    <form action="{{ route('posts.store') }}" method="POST">
        @csrf
        
        <div class="mb-3">
            <label for="title" class="form-label">Title</label>
            <input type="text" class="form-control @error('title') is-invalid @enderror" id="title" name="title" value="{{ old('title') }}">
            @error('title')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
        
        <div class="mb-3">
            <label for="content" class="form-label">Content</label>
            <textarea class="form-control @error('content') is-invalid @enderror" id="content" name="content" rows="5">{{ old('content') }}</textarea>
            @error('content')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
        
        <div class="mb-3 form-check">
            <input type="checkbox" class="form-check-input" id="is_published" name="is_published" value="1" {{ old('is_published') ? 'checked' : '' }}>
            <label class="form-check-label" for="is_published">Publish immediately</label>
        </div>
        
        <button type="submit" class="btn btn-primary">Submit</button>
    </form>
@endsection