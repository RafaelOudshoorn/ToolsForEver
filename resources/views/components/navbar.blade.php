<nav class="navbar navbar-expand-lg navbar-dark bg-primary">
    <div class="container-fluid">
        <a class="navbar-brand" href="/">ToolsForEver</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation" style="border:none;">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                <li class="nav-item">
                    <a class="nav-link active" aria-current="page" href="/"><i class="fa-solid fa-house"></i> Home</a>
                </li>
            </ul>
            <ul class="navbar-nav ms-auto mb-2 mb-lg-0 profile-menu"> 
                {{-- Wanneer niet ingelogt --}}
                @guest
                <li class="nav-item">
                    <a class="nav-link active" aria-current="page" href="winkelwagen"><i class="fa-solid fa-cart-shopping"></i> Winkelwagen</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link active" aria-current="page" href="login">login</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link active" aria-current="page" href="register">register</a>
                </li>
                @else
                {{-- Wanneer wel ingelogt --}}
                <li class="nav-item mr-5">
                    <a class="nav-link active" aria-current="page" href="/winkelwagen">
                        <i class="fa-solid fa-cart-shopping"></i> Winkelwagen
                        @php
                            echo "<script>";
                            echo "let navTotal = ";
                            foreach($winkelwagenItems as $navItem){
                                echo "$navItem->total + ";
                            }
                            echo "0;";
                            echo "if(navTotal != 0){if(navTotal >= 100){navTotal = '99+';}document.write('( '+navTotal+' )');}";
                            echo "</script>";
                        @endphp
                    </a>
                </li>
                @if (Auth::user()->role_id != 2) 
                @else
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle text-light" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        <i class="fas fa-lock"></i> Admin Tools
                    </a>
                    <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                        <li>
                            <a class="dropdown-item" aria-current="page" href="/product/aanmaken"><i class="fa-solid fa-plus"></i> Product toevoegen</a>
                        </li>
                    </ul>
                </li>
                @endif
                <li class="nav-item dropdown" style="min-width:130px">
                    <a class="nav-link dropdown-toggle text-light" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        <i class="fas fa-user"></i>
                        {{ Auth::user()->name }}
                        @if (Auth::user()->role_id != 2) 
                        @else
                            (Admin)
                        @endif
                    </a>
                    <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                        <li><a class="dropdown-item" href="/account/"><i class="fas fa-sliders-h fa-fw"></i> Account</a></li>
                        <li><a class="dropdown-item" href="/account/bestellingen"><i class="fa-solid fa-box fa-fw"></i> Bestellingen</a></li>
                        <li><hr class="dropdown-divider"></li>
                        <li>
                            <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                <i class="fa-solid fa-right-from-bracket"></i> {{ __('Logout') }}
                            </a>
                            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                @csrf
                            </form>
                        </li>
                    </ul>
                </li>
                @endguest
            </ul>
        </div>
    </div>
</nav>