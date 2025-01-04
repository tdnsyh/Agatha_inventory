<nav class="navbar navbar-expand navbar-light navbar-top">
    <div class="container-fluid">
        <a class="burger-btn d-block" href="#">
            <i class="bi bi-justify fs-3"></i>
        </a>

        <button data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
            aria-expanded="false" aria-label="Toggle navigation" class="navbar-toggler" type="button">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav ms-auto mb-lg-0">

            </ul>
            <div class="dropdown">
                <a data-bs-toggle="dropdown" aria-expanded="false" href="#">
                    <div class="user-menu d-flex">
                        <div class="user-name text-end me-3">
                            @if (auth()->check())
                                <h6 class="mb-0 text-gray-600">{{ auth()->user()->full_name }}</h6>
                                <p class="mb-0 text-sm text-gray-600">{{ auth()->user()->role ?? 'Administrator' }}</p>
                            @else
                                <h6 class="mb-0 text-gray-600">Guest</h6>
                                <p class="mb-0 text-sm text-gray-600">Not Logged In</p>
                            @endif
                        </div>
                        <div class="user-img d-flex align-items-center">
                            <div class="avatar avatar-md">
                                @if (auth()->check() && auth()->user()->avatar_url)
                                    <img src="{{ auth()->user()->avatar_url }}" alt="User Avatar">
                                @else
                                    <img src="{{ asset('assets/compiled/jpg/2.jpg') }}" alt="Default Avatar">
                                @endif
                            </div>
                        </div>
                    </div>
                </a>
                <ul aria-labelledby="dropdownMenuButton" class="dropdown-menu dropdown-menu-end"
                    style="min-width: 11rem;">
                    @if (auth()->check())
                        <li>
                            <h6 class="dropdown-header">Hello, {{ auth()->user()->full_name }}!</h6>
                        </li>
                        <li><a class="dropdown-item" href="#"><i class="icon-mid bi bi-person me-2"></i> My
                                Profile</a></li>
                        <li>
                            <hr class="dropdown-divider">
                        </li>
                        <li>
                            <a class="dropdown-item" href="#"
                                onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                <i class="icon-mid bi bi-box-arrow-left me-2"></i> Logout
                            </a>
                            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                @csrf
                            </form>
                        </li>
                    @else
                        <li><a class="dropdown-item" href="{{ route('login') }}"><i
                                    class="icon-mid bi bi-box-arrow-right me-2"></i> Login</a></li>
                    @endif
                </ul>
            </div>
        </div>
    </div>
</nav>
