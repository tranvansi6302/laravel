<nav class="navbar shadow navbar-expand-lg bg-body">
    <div class="container">
        <a class="navbar-brand fw-bold fs-2 mb-1 text-secondary d-flex align-items-center gap-2" href="">
            <img src="https://laravel.com/img/logomark.min.svg" alt="">
            <img src="https://laravel.com/img/logotype.min.svg" alt="">
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent"
            aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav me-auto mb-2 ms-lg-5 mb-lg-0 d-flex align-items-center gap-2">
                <li class="nav-item">
                    <a class="nav-link d-flex align-items-center gap-1 {{ request()->routeIs('home')==route('home') ?'active':false }}" aria-current="page" href="{{ route('home') }}">
                        <i class="fa-solid fa-house-blank"></i>
                        Home
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link d-flex align-items-center gap-1 {{ request()->routeIs('validation')==route('validation') ?'active':false }}" aria-current="page" href="{{ route('validation') }}">
                        <i class="fa-sharp fa-solid fa-badge-check"></i>
                        Validation
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link d-flex align-items-center gap-1 {{ request()->routeIs('users.index')==route('users.index') ?'active':false }}" aria-current="page" href="{{ route('users.index') }}">
                        <i class="fa-solid fa-user-shield"></i>
                        Manager Users
                    </a>
                </li>
            </ul>
            <form class="d-flex" role="search">
                <input class="form-control me-2" type="search" placeholder="Search..." aria-label="Search">
                <button class="btn btn-outline-success px-4" type="submit">
                    <i class="fa-regular fa-magnifying-glass"></i>
                </button>
            </form>
        </div>
    </div>
</nav>
