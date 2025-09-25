@extends('layouts.main')
@section('title', 'Post | Create')

@section('content')

    <div class="container">
        <h5 class="text-center fw-bold">Create New Article</h5>

        <form class="m-1 p-1" action="{{ route('posts.store') }}" method="POST">
            @csrf
            <input type="hidden" name="redirect_to" value="{{ url()->previous() }}">
            <div class="title">
                <label for="title" class="form-label">Article Title</label>
                <input type="text" name="title" value="{{ old('title') }}" id="title" class="form-control"
                    placeholder="Article title">
                @error('title')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>

            <div class="content">
                <label for="article" class="form-label mt-4">Article</label>
                <textarea id="article" name="content" class="form-control" placeholder="Write Article"
                    rows="6">{{ old('content') }}</textarea>
                @error('content')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>

            <div class="form-group mt-4">
                <label for="categorySelect" class="form-label fw-bold">Category</label>
                <select multiple id="categorySelect" name="categories[]" class="form-select">
                    <option value="" disabled selected>--Choose category--</option>
                    @foreach ($categories as $category)
                        <option value="{{ $category->id }}">{{ $category->name }} | {{ $category->description }}</option>
                    @endforeach
                </select>
                @error('categories')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>

            <div class="form-group mt-4">
                <label for="tags" class="form-label fw-bold">Tags</label>
                <select id="tags" name="tags[]" class="form-select" multiple size="5">
                    <option disabled selected>--Select Tags--</option>
                    @foreach ($tags as $tag)
                        <option value="{{ $tag->id }}">{{ $tag->name }}</option>
                    @endforeach
                </select>
            </div>

            <div class="d-flex justify-content-center align-items-center mt-4 gap-3">
                <button type="submit" class="btn btn-primary">Create</button>
                <a href="{{ old('redirect_to', url()->previous()) }}" class="btn btn-danger">Cancel</a>
            </div>
        </form>
    </div>

@endsection