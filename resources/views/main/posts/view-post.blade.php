@extends('layouts.main')
@section('title', 'Post')

@section('content')

    <div class="author">
        <div class="text-start">
            <x-ui.btn href="{{ route('profile.other', $post->user) }}">
                <img src="{{asset($post->user->profile->avatar) }}" class="rounded-circle" style="width: 35px; height: 35px"
                    alt="">
                <p class="d-inline">{{$post->user->name}}</p>
                </x-ui>
                <div class="card-footer text-muted small mb-2">
                    <span class="d-block">Created: {{ $post->created_at->diffForHumans() }}</span>
                    <span>Last Updated: {{ $post->updated_at->diffForHumans() }}</span>
                </div>
        </div>
    </div>
    <div class="head">
        <h1 class="text-center">{{ $post->title }}</h1>
    </div>
    <div class="d-flex flex-wrap gap-3 my-4">
        <p class="article">
            {{ $post->content }}
        </p>
    </div>
    <div class="text-center m-3 p-4">
        @if ($post->user->id === Auth::user()->id)
            <div class="d-block mb-2">
                <x-ui.btn class="btn-primary" href="{{ route('posts.edit', $post) }}">Update</x-ui.btn>
                <x-ui.btn onclick="return confirm('Are you sure?!')" method="DELETE" class="btn-danger"
                    href="{{ route('posts.delete', $post) }}">Delete</x-ui.btn>
            </div>
        @endif
        <a href="{{ route('posts.index') }}" class="btn btn-primary">Go back</a>
    </div>
    <div class="comments mt-5">
        <h5>Comments ({{ $post->comments->count() }})</h5>

        @forelse ($post->comments as $comment)
            <div class="mb-3 p-3 border rounded">
                <div class="d-flex align-items-center mb-1">
                    <div class="user d-inline">
                        <x-ui.btn href="{{ route('profile.other', $comment->user) }}">
                            <img src="{{asset($comment->user->profile->avatar) }}" class="rounded-circle"
                                style="width: 35px; height: 35px" alt="">
                            <p class="d-inline">{{$comment->user->name}}</p>
                        </x-ui.btn>
                    </div>
                    <div class="ms-auto">
                        <span class="text-muted small d-block">Created: {{ $comment->created_at->diffForHumans() }}</span>
                        <span class="text-muted small">Last edit: {{ $comment->updated_at->diffForHumans() }}</span>
                    </div>
                </div>
                <p>{{ $comment->content }}</p>

                @if (Auth::id() === $comment->user_id)
                    <div class="delete text-end">
                        <x-ui.btn href="{{ route('comments.edit', $comment) }}" class="btn-primary">
                            Edit
                        </x-ui.btn>
                        <x-ui.btn onclick="return confirm('Delete this comment?')" href="{{ route('comments.destroy', $comment) }}"
                            method="DELETE" class="btn-danger">
                            Delete
                        </x-ui.btn>

                    </div>
                @endif
            </div>
        @empty
            <p class="text-muted">No comments yet. Be the first to comment!</p>
        @endforelse

        @auth
            <form action="{{ route('comments.store', $post) }}" method="POST" class="mt-4">
                @csrf
                <textarea name="content" rows="3" class="form-control" placeholder="Add a comment..." required></textarea>
                <button type="submit" class="btn btn-primary btn-sm mt-2">Comment</button>
            </form>
        @else
            <p class="mt-3 text-muted">Please <a href="{{ route('login') }}">login</a> to comment.</p>
        @endauth
    </div>


@endsection