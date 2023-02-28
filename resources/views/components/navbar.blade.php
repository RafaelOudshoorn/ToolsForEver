    <nav class="navbar navbar-expand-lg bg-primary p-3 nav-main" style="display:grid;grid-template-columns: auto 40% 50%">
        <span class="navbar-brand mb-0 h1 text-white">ToolsForEver</span>
        <ul class="navbar-nav">
            <li class="nav-item active">
                <a class="nav-item nav-link active text-dark bg-light" href="/"> Home</a>
            </li>
        </ul>
        <ul class="navbar-nav d-flex justify-content-end" style="margin-right:-50px">
            @guest
            <li class="nav-item active">
                <a class="nav-item nav-link active text-white" href="../login">Inloggen</a>
            </li>
            <li class="nav-item active">
                <a class="nav-item nav-link active text-white" href="../register">Registeren</a>
            </li>
            <li class="nav-item active">
                <a class="nav-item nav-link active text-dark bg-light" href="/winkelwagen"><span class="material-symbols-outlined">shopping_cart</span> Winkelwagen</a>
            </li>
            @else
                @if (Auth::user()->role_id != 2) 
                @else
                <li class="nav-item active">
                    <a class="nav-item nav-link active text-dark bg-light" href="/product/aanmaken">+ Toevoegen Product </a>
                </li>
                @endif
            <li class="nav-item active">
                <a class="nav-item nav-link active text-dark bg-light" href="/winkelwagen">
                    <span class="material-symbols-outlined">
                        shopping_cart
                    </span> 
                    Winkelwagen
                    <?php
                        echo "<script>";
                        echo "let navTotal = ";
                        foreach($winkelwagenItems as $navItem){
                            echo "$navItem->total + ";
                        }
                        echo "0;";
                        echo "if(navTotal != 0){if(navTotal >= 100){navTotal = '99+';}document.write('( '+navTotal+' )');}";
                        echo "</script>";
                    ?>
                </a>
            </li>
            <li class="nav-item active">
                <div class="dropdown nav-item text-dark bg-light">
                    <a id="Dropdown" class="nav-item nav-link active dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                        {{ Auth::user()->name }}
                        @if (Auth::user()->role_id != 2) 
                        @else
                            (Admin)
                        @endif
                    </a>
                    <div class="dropdown-menu dropdown-menu-end" aria-labelledby="Dropdown">
                        <a class="nav-item nav-link active bg-white text-dark dropdown-item" href="/user/bestellingen">
                            {{ __('Bestelingen') }}
                        </a>
                        <a class="nav-item nav-link active bg-white text-dark dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                            {{ __('Logout') }}
                        </a>
                        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                            @csrf
                        </form>
                    </div>
                </div>
            </li>
            @endguest    
        </ul>
    </nav>
