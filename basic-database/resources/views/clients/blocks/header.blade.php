<nav class="navbar shadow navbar-expand-lg bg-body-tertiary">
    <div class="container">
        <a  class="navbar-brand fw-bold fs-2 mb-1 text-secondary d-flex align-items-center gap-2" href="{{ route('home') }}">
            <img src="https://laravel.com/img/logomark.min.svg" alt="">
            <span style="color: #FF2D20">Laravel</span>
            
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent"
            aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                <li class="nav-item">
                    <a class="nav-link d-flex align-items-center gap-1" aria-current="page" href="{{ route('home') }}">
                        <i class="fa-solid fa-house-blank"></i>
                        Trang chủ
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link d-flex align-items-center gap-1" aria-current="page" href="{{ route('products') }}">
                        <i class="fa-sharp fa-solid fa-shirt"></i>
                        Sản phẩm
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link d-flex align-items-center gap-1" aria-current="page" href="{{ route('users.index') }}">
                        <i class="fa fa-user"></i>
                        Người dùng
                    </a>
                </li>
            </ul>
            <form class="d-flex" role="search">
                <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
                <button class="btn btn-outline-success" type="submit">Search</button>
            </form>
        </div>
    </div>
</nav>
