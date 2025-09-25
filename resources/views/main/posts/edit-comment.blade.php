@extends('layouts.main')
@section('title', 'Comment | Edit')

@section('content')

    <div class="container">
        <h5 class="text-center fw-bold">Edit Comment</h5>
        <h6 class="text-center fw-bold text text-primary">For: {{$comment->post->title}}</h6>

        <form class="m-1 p-1" action="{{ route('comments.update', $comment) }}" method="POST">
            @csrf
            @method('PUT')
            <label for="comment" class="form-label mt-4">Comment</label>
            <textarea id="comment" name="content" class="form-control" placeholder="Write your comment"
                rows="3">{{ old('comment', $comment->content) }}</textarea>
                @error('content')
                <span style="color: red;">{{ $message }}</span>
                @enderror
            <div class="action my-3">
                <button type="submit" class="btn btn-primary">Update</button>
                <x-ui.btn class="btn-danger" href="{{ route('posts.view',$comment->post->id)}}">Back</x-ui.btn>
            </div>
        </form>

@endsection