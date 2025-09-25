@extends('layouts.main')
@section('title', 'Change Password')

@section('content')

    @if (session()->has('error'))
        <div class="alert alert-danger">
            {{ session('error') }}
        </div>
    @endif

    <div class="container d-flex justify-content-center align-items-center">
        <form action="{{ route('profile.updatepw') }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')


            <div class="form-group mb-3">
                <label for="password_current">Current Password</label>
                <input type="password" name="current_password" class="form-control" id="password_current"
                    placeholder="Current Password">
                @error('current_password')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>
            <div class="form-group mb-3">
                <label for="password">Password</label>
                <input type="password" name="password" class="form-control" id="password" placeholder="Password">
                @error('password')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>
            <div class="form-group mb-3">
                <label for="password_confirmation">Confirm Password</label>
                <input type="password" name="password_confirmation" class="form-control" id="password_confirmation"
                    placeholder="Confirm Password">
                @error('password_confirmation')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>
            <div class="my-4">
                <button type="submit" name="update" class="btn btn-primary">Update</button>
                <x-ui.btn class="btn-danger" href="{{ route('profile.edit') }}">Back</x-ui.btn>
            </div>
        </form>
    </div>

@endsection