@extends('layouts.main')

@section('title', 'Login')

@section('content')

    <div class="container">
        @if (session('login'))
        <div class="alert alert-danger">{{ session('login') }}</div>
        @endif
        <h3 class="text-center fw-bold">Login</h3>

            <div class="d-flex align-items-center justify-content-center m-4">
                <form action="{{ route('login.req')}}" method="POST">
                    @csrf
                    <div class="form-group">
                        <label for="exampleInputEmail1">Email address</label>
                        <input type="email" name="email" class="form-control" id="exampleInputEmail1"
                            aria-describedby="emailHelp" placeholder="Enter email">
                        @error('email')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="exampleInputPassword1">Password</label>
                        <input type="password" name="password" class="form-control" id="exampleInputPassword1"
                            placeholder="Password">
                        @error('password')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="auth my-3">
                        <button type="submit" class="btn btn-success">Login</button>
                        <x-ui.btn href="{{ route('register')}}" class="btn-primary">Register</x-ui.btn>
                    </div>
                </form>
            </div>
    </div>

@endsection