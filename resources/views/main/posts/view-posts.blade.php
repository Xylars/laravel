@extends('layouts.main')
@section('title', 'Posts')

@section('content')

  <div class="container">
    @if (session('success'))
      <p class="alert alert-success">{{ session('success') }}</p>
    @endif
    <h3 class="text-center fw-bold">Articles</h3>
    @if ($posts->isEmpty())
      <p class="text-center fw-bold mt-5">No articles posted yet</p>
      <p class="text-center fw-bold">Be the first to create one!</p>
      <div class="empty d-flex justify-content-center align-items-center">

        <x-ui.btn href="{{ route('posts.create') }}" class="btn-primary">Create</x-ui.btn>
      </div>


    @endif
    @foreach ($posts as $post)
      <div class="card my-3 w-75">
        <div class="card-header d-flex align-items-center justify-content-between">
          <div class="d-flex align-items-center gap-2">
            <x-ui.btn href="{{ route('profile.other', $post->user->id) }}" class="d-flex align-items-center gap-2">
              <img src="{{ asset($post->user->profile->avatar) }}" class="rounded-circle"
                style="width: 35px; height: 35px; object-fit: cover;">
              <span class="fw-bold">{{ $post->user->name }}</span>
            </x-ui.btn>
          </div>

          <div class="flex-grow-1 text-center">
            <h4 class="fw-bold text-primary m-0">{{ $post->title }}</h4>
          </div>

          <div class="d-flex ms-auto">
            @if ($post->user->id === Auth::user()->id)
              <x-ui.btn href="{{ route('posts.edit', $post) }}" class="btn-primary me-1">Update</x-ui-btn>
                <x-ui.btn method="DELETE" onclick="return confirm('Are you sure?!')" href="{{ route('posts.delete', $post) }}"
                  class="btn-danger">Delete</x-ui-btn>
            @endif
          </div>
        </div>
        <div class="card-header">
          <span class="fw-bold small me-1">Categories:</span>
          @foreach($post->category as $cat)
            <span class="badge bg-primary">{{ $cat->name }}</span>
          @endforeach
        </div>
        @if ($post->tag->isNotEmpty())
          <div class="card-header">
            <span class="fw-bold small me-1">Tags:</span>
            @foreach($post->tag as $t)
              <span class="badge bg-secondary">{{ $t->name }}</span>
            @endforeach
          </div>
        @endif
        <div class="card-body">

          <div class="d-flex fw-bold justify-content-center align-items-center">
            <span class="card-title  badge bg-success">Content</span>
          </div>
          <p class="card-text">
            {{ Str::limit($post->content, 100, '...') }}
          </p>

          <div class="d-flex align-items-end justify-content-end">
            <a href="{{route('posts.view', $post)}}" class="btn btn-primary">View Article</a>
          </div>
        </div>
        <div class="card-footer text-muted small">
          <span>Last Updated: {{ $post->updated_at->diffForHumans() }}</span>
          <span class="d-block">Created: {{ $post->created_at->diffForHumans() }}</span>
        </div>
      </div>

    @endforeach




    <div class="my-3 d-flex align-items-center justify-content-center">
      {{ $posts->links() }}
    </div>

@endsection