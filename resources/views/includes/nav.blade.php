<nav class="navbar navbar-expand-lg bg-body-tertiary">
    <div class="container-fluid">
        <a class="navbar-brand fw-bold" href="#">Logo</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent"
            aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                <li class="nav-item">
                    <a class="nav-link active" aria-current="page" href="{{ route('posts.index') }}">Home</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{route('profile.self')}}">Profile</a>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown"
                        aria-expanded="false">
                        Article
                    </a>
                    <ul class="dropdown-menu">
                        <li><a class="dropdown-item" href="{{route('posts.create')}}">Create New Article</a></li>
                        <li><a class="dropdown-item" href="{{ route('posts.index') }}">View Articles</a></li>
                    </ul>
                </li>
            </ul>
            <div class="d-flex flex-wrap gap-4">
                <!-- <form class="d-flex" role="search">
                        <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search" />
                        <button class="btn btn-outline-success" type="submit">Search</button>
                    </form> -->
                @guest
                    <div class="guest">
                        <x-ui.btn class="btn-success" href="{{ route('login') }}">Login</x-ui.btn>
                        <x-ui.btn class="btn-primary" href="{{ route('register') }}">Register</x-ui.btn>
                    </div>
                @endguest
                @auth
                    @php
                        $user = Auth::user();
                    @endphp
                    <li class="nav-item dropdown list-unstyled mx-3">
                        <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown"
                            aria-expanded="false">
                            <div class="profile d-inline">
                                <img src="{{asset($user->profile->avatar) }}" class="rounded-circle"
                                    style="width: 35px; height: 35px" alt="">
                                <p class="d-inline">{{$user->name}}</p>
                            </div>
                        </a>
                        <ul class="dropdown-menu">
                            <li><x-ui.btn class="dropdown-item" href="{{ route('profile.self') }}">Profile</x-ui.btn></li>

                            <li>
                                <hr class="dropdown-divider">
                            </li>
                            <li><x-ui.btn class="btn-danger-inline" method="POST"
                                    href="{{ route('logout') }}">Logout</x-ui.btn></li>
                        </ul>
                    </li>
                @endauth
            </div>
        </div>
    </div>
</nav>