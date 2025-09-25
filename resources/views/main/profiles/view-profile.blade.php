@extends('layouts.main')
@section('title', 'Profile | Edit')

@section('content')
    <div class="col p-4">
        <div class="card mb-3 mx-auto" style="max-width: 640px;">
            <div class="row g-0">
                <div class="col-md-4 d-flex justify-content-center align-items-center">
                    <img src="{{ asset($user->profile->avatar) }}" class="rounded-circle"
                        style="width: 150px; height: 150px" alt="avatar">
                </div>
                <div class="col-md-8">
                    <div class="card-body">
                        <h5 class="card-title">{{ $user->name }}</h5>
                        <p class="card-text text-muted">{{ $user->profile->bio }}</p>
                        <p class="card-text"><small class="text-muted">{{$user->posts()->count()}} Articles · Last update
                                {{ $user->updated_at->diffForHumans() }}</small></p>
                        <p class="card-text"><small class="text-muted">Joined:
                                {{ $user->created_at->diffForHumans() }}</small></p>
                        @if ($user === Auth::user())
                            <x-ui.btn href="{{ route('profile.edit') }}" class="btn-primary btn-sm">Edit Profile</x-ui.btn>
                        @else
                            <x-ui.btn href="#" class="btn-primary btn-sm">Contact</x-ui.btn>
                        @endif
                    </div>
                </div>
            </div>
        </div>

        {{-- User Posts --}}
        <h4 class="mb-3 text-center">Articles by {{ $user->name }}</h4>

        @if ($posts->count() === 0)
            <p class="text-center fw-bold">No posts yet!</p>
        @else
            <div class="row g-4">
                @foreach ($posts as $post)
                    <div class="col-md-6 col-lg-4">
                        <div class="card h-100 shadow-sm">
                            <div class="card-body d-flex flex-column">
                                <h5 class="card-title">{{ $post->title }}</h5>

                                @if($post->category->count())
                                    <div class="mb-2">
                                        @foreach($post->category as $cat)
                                            <span class="badge bg-primary">{{ $cat->name }}</span>
                                        @endforeach
                                    </div>
                                @endif

                                @if($post->tag->count())
                                    <div class="mb-2">
                                        @foreach($post->tag as $t)
                                            <span class="badge bg-secondary">{{ $t->name }}</span>
                                        @endforeach
                                    </div>
                                @endif

                                <p class="card-text text-truncate" style="max-height: 5rem;">
                                    {{ Str::limit($post->content, 120, '...') }}
                                </p>

                                <div class="mt-auto">
                                    <p class="text-muted small mb-2">
                                        Created: {{ $post->created_at->diffForHumans() }} <br>
                                        Updated: {{ $post->updated_at->diffForHumans() }}
                                    </p>
                                    <a href="{{ route('posts.view', $post) }}" class="btn btn-primary btn-sm">View Article</a>
                                    @if ($user->id === Auth::id())
                                        <a href="{{ route('posts.edit', ['post' => $post, 'redirect_to' => url()->current()]) }}"
                                            class="btn btn-success btn-sm">Edit</a> <x-ui.btn href="{{ route('posts.delete', $post) }}"
                                            method="DELETE" class="btn btn-danger btn-sm"
                                            onclick="return confirm('Are you sure you want to delete this article?')">Delete</x-ui.btn>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>

            <div class="my-4 d-flex justify-content-center">
                {{ $posts->links() }}
            </div>
        @endif

    </div>

@endsection