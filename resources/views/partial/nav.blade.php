<nav class=" navbar navbar-expand-lg navbar-light white z-depth-1">
    <a class="navbar-brand" href="#">Navbar</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent-4" aria-controls="navbarSupportedContent-4" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarSupportedContent-4">
        <ul class="navbar-nav ml-auto">
            <li class="nav-item">
                <a class="nav-link waves-effect waves-light  text-nav" href="{{ url('/') }}">
                    <i class="fa fa-home"></i> Home</a>
            </li>
            @guest
            <li class="nav-item">
                <a class="nav-link waves-effect waves-light  text-nav" href="{{ route('login') }}">
                    <i class="fa fa-login"></i> Login</a>
            </li>
            <li class="nav-item">
                <a class="nav-link waves-effect waves-light  text-nav" href="{{ route('register') }}">
                    <i class="fa fa-register"></i> Register</a>
            </li>
            @else
            <li class="nav-item">
                <a class="nav-link waves-effect waves-light  text-nav" href="{{ route('dashboard.index') }}">
                    <i class="fa fa-tachometer"></i> Dashboard</a>
            </li>
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle waves-effect waves-light text-nav" id="navbarDropdownMenuLink-4" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                    <i class="fa fa-cog"></i><b>{{Auth::user()->name}} <b></a>
                <div class="dropdown-menu dropdown-menu-right dropdown-info" aria-labelledby="navbarDropdownMenuLink-4">
                    <a class="dropdown-item waves-effect waves-light text-nav" href="#">Account</a>
                    <a class="dropdown-item waves-effect waves-light text-nav" href="{{ route('logout') }}"
                                    onclick="event.preventDefault();
                                             document.getElementById('logout-form').submit();">
                        Log out
                    </a>
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                        {{ csrf_field() }}
                    </form>
                </div>
            </li>
            @endguest
        </ul>
    </div>
</nav>