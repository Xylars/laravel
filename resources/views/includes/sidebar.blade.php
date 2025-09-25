<div class="container-fluid">
    <div class="row">
        <div class="col-2 border-end min-vh-100 d-flex flex-column">
            <a href="/" class="d-flex align-items-center mb-3 mb-md-0 me-md-auto link-dark text-decoration-none">
                <svg class="bi me-2" width="40" height="32">
                    <use xlink:href="#bootstrap"></use>
                </svg>
                <span class="fs-4">Laravel</span>
            </a>
            <hr>
            <ul class="nav nav-pills flex-column mb-auto">
                <li class="nav-item">
                    <a href="{{ route('posts.index') }}" class="nav-link active" aria-current="page">
                        <svg class="bi me-2" width="16" height="16">
                            <use xlink:href="#home"></use>
                        </svg>
                        Home
                    </a>
                </li>
                <li>
                    @if (Auth::user() && Auth::user()->is_admin)
                        @php
                            $dashboard = 'http://localhost/project/'
                        @endphp
                        <a href="{{ $dashboard }}" class="nav-link link-dark">
                            <svg class="bi me-2" width="16" height="16">
                                <use xlink:href="#speedometer2"></use>
                            </svg>
                            Dashboard
                        </a>
                    @endif
                </li>
                </li>
            </ul>
            <hr>
        </div>

        <div class="col-9 p-4">