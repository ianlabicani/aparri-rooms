<nav class="navbar navbar-expand-lg navbar-light bg-light border-bottom fixed-top">
    <div class="container-fluid">
        <!-- Brand Logo -->
        <a class="navbar-brand fw-bold d-flex align-items-center" href="{{ route('welcome') }}">
            <img src="{{ asset('logo/aparri-rooms.jpg') }}" alt="Logo" width="50" height="50"
                class="d-inline-block align-text-top">
            <span class="navbar-brand fw-bold">Aparri Rooms</span>
        </a>

        <!-- Toggler for Mobile -->
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
            aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <!-- Navbar Links -->
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav me-auto">
                <li class="nav-item">
                    <a class="nav-link active" aria-current="page" href="{{ route('welcome') }}">Home</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">About Us</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">Contact</a>
                </li>
            </ul>

            <!-- Auth Links for Guests -->
            <ul class="navbar-nav">
                @auth
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('dashboard') }}">Dashboard</a>
                        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none"
                            action="{{ route('logout') }}">
                            @csrf
                        </form>
                    </li>
                @else
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('login') }}">Login</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('register') }}">Register</a>
                    </li>
                @endauth
            </ul>


        </div>
    </div>
</nav>
