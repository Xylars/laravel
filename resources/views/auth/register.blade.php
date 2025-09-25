@extends('layouts.main')

@section('title', 'Register')

@section('content')

    <div class="container">
        <div class="m-4 min-vh-100">
            <h3 class="text-center fw-bold">Register</h3>
                <form action="{{route('register.req')}}" method="POST">
                    @csrf
                    <div class="form-group col-md-6">
                        <label for="inputName">Name</label>
                        <input type="text" name="name" value="{{ old('name') }}" class="form-control" id="inputName"
                            placeholder="Name">
                        @error('name')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="form-group col-md-6">
                        <label for="inputEmail4">Email</label>
                        <input type="email" name="email" value="{{ old('email') }}" class="form-control" id="inputEmail4"
                            placeholder="Email">
                        @error('email')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="form-group col-md-6">
                        <label for="inputPassword4">Password</label>
                        <input type="password" name="password" class="form-control" id="inputPassword4"
                            placeholder="Password">
                        @error('password')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="form-group col-md-6">
                        <label for="inputPassword4">Confirm Password</label>
                        <input type="password" name="password_confirmation" class="form-control" id="inputPassword4"
                            placeholder="Password">
                        @error('password_confirmation')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="inputPhone">Phone</label>
                            <input type="text" name="phone" value="{{ old('phone') }}" class="form-control" id="inputPhone"
                                placeholder="Phone">
                            @error('phone')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="actions my-4">
                            <button type="submit" class="btn btn-primary">Register</button>
                            <x-ui.btn class="btn-danger" href="{{ route('login') }}">Back</x-ui.btn>
                        </div>
                </form>
        </div>
    </div>

@endsection