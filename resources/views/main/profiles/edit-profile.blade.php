@extends('layouts.main')
@section('title', 'Profile | Edit')

@section('content')

    <div class="container">
        <form action="{{route('profile.update')}}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="form-group col-md-3 my-4">
                <input type="hidden" name="redirect_to" value="{{ request('redirect_to', route('posts.index')) }}">

                <label for="inputformFile4" class="d-inline text-center">Avatar</label>

                <div class="av my-3">
                    <input type="file" name="avatar" id="avatarupload" style="display:none;">
                    <label for="avatarupload" style="cursor: pointer;">
                        <img id="updateimg" src="{{ asset($user->profile->avatar) }}" width="80" height="80"
                            style="border-radius:50%;">
                    </label>
                    @error('avatar')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
                <a id="remove_avatar" class="mx-2 sm text-decoration-none" style="cursor:pointer; color:red;">Remove</a>
                <input type="hidden" name="remove_avatar" id="remove_avatar_input" value="0">

            </div>
            <div class="form-row">
                <div class="form-group col-md-6">
                    <label for="inputName4">Name</label>
                    <input type="text" value="{{ old('name', $user->name) }}" name="name" class="form-control"
                        id="inputName4" placeholder="Name">
                    @error('name')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
                <div class="form-group col-md-6">
                    <label for="inputEmail4">Email</label>
                    <input type="email" value="{{ old('email', $user->email) }}" name="email" class="form-control"
                        id="inputEmail4" placeholder="Email">
                    @error('email')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
                <div class="form-group col-md-6">
                    <label for="inputPhone4">Phone</label>
                    <input type="text" value="{{ old('phone', $user->phone) }}" name="phone" class="form-control"
                        id="inputPhone4" placeholder="Enter your phone number">
                    @error('phone')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
                <div class="form-group col-md-6">
                    <label for="bio">Bio</label>
                    <textarea name="bio" class="form-control" id="bio" rows="2"
                        placeholder="Write your biography">{{ old('bio', $user->profile->bio) }}</textarea>
                </div>
                <div class="my-4">
                    <button type="submit" name="update" class="btn btn-primary">Update</button>
                    <x-ui.btn class="btn-danger" href="{{ route('profile.self') }}">Cancel</x-ui.btn>
                </div>
                <div class="pw">
                    <small class="text-muted d-block my-2">Change your password?</small>
                    <x-ui.btn class="btn-primary btn-sm mb-4" href="{{route('profile.changepw')}}">Change
                        Password</x-ui.btn>
                </div>
        </form>
    </div>
    @push('scripts')
        <script src="{{ asset('assets/scripts/app.js') }}"></script>
    @endpush
@endsection