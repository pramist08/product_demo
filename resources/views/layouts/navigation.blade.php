<nav class="navbar navbar-expand-lg navbar-dark bg-dark shadow-sm">
    <div class="container-fluid">

        <a class="navbar-brand fw-bold" href="{{ route('dashboard') }}">
            Product Management
        </a>

        <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
            data-bs-target="#navbarNav">

            <span class="navbar-toggler-icon"></span>

        </button>

        <div class="collapse navbar-collapse" id="navbarNav">

            <ul class="navbar-nav me-auto">

                <li class="nav-item">

                    <a class="nav-link {{ request()->routeIs('dashboard') ? 'active' : '' }}"
                        href="{{ route('dashboard') }}">

                        Dashboard

                    </a>

                </li>

                <li class="nav-item">

                    <a class="nav-link"
                        href="{{ route("products.index") }}">

                        Products

                    </a>

                </li>
                <li class="nav-item">

                    <a class="nav-link"
                        href="{{ route("products.create") }}">

                        create Products

                    </a>

                </li>

                <!-- <li class="nav-item">

                    <a class="nav-link"
                        href="#">

                        Categories

                    </a>

                </li> -->

            </ul>

            <ul class="navbar-nav">

                <li class="nav-item dropdown">

                    <a class="nav-link dropdown-toggle"
                        href="#"
                        role="button"
                        data-bs-toggle="dropdown">

                        {{ Auth::user()->name }}

                    </a>

                    <ul class="dropdown-menu dropdown-menu-end">

                        <li>

                            <a class="dropdown-item"
                                href="{{ route('profile.edit') }}">

                                My Profile

                            </a>

                        </li>

                        <li>

                            <hr class="dropdown-divider">

                        </li>

                        <li>

                            <form action="{{ route('logout') }}" method="POST">

                                @csrf

                                <button class="dropdown-item">

                                    Logout

                                </button>

                            </form>

                        </li>

                    </ul>

                </li>

            </ul>

        </div>

    </div>
</nav>