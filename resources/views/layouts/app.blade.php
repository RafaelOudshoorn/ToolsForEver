<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <!-- CSRF Token -->
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <title>{{ config('app.name', 'Laravel') }}</title>
        <!-- Scripts -->
        <script src="{{ asset('js/app.js') }}" defer></script>
        <script src="https://code.jquery.com/jquery-3.6.3.min.js" integrity="sha256-pvPw+upLPUjgMXY0G+8O0xUf+/Im1MZjXxxgOcBQBXU=" crossorigin="anonymous"></script>
        <!-- Fonts -->
        <link rel="dns-prefetch" href="//fonts.gstatic.com">
        <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">
        <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.3.0/css/all.min.css" integrity="sha512-SzlrxWUlpfuzQ+pcUCosxcglQRNAq/DZjVsC0lE40xsADsfeQoEypE+enwcOiGjk/bSuGGKHEyjSoQ1zVisanQ==" crossorigin="anonymous" referrerpolicy="no-referrer" />
        <!-- Styles -->
        <link href="{{ asset('css/app.css') }}" rel="stylesheet">
        <link href="{{ asset('css/navbar.css') }}" rel="stylesheet">
        <style>
            .profile-menu { 
                .dropdown-menu{
                    right: 0;
                    left: unset;
                }
                .fa-fw{
                    margin-right: 10px;
                }  
            }
            .toggle-change{
                &::after {
                border-top: 0;
                border-bottom: .3em solid;
                }
            } 
        </style>
        <script>
            document.querySelectorAll('.dropdown-toggle').forEach(item => {
                item.addEventListener('click', event => {
                    if(event.target.classList.contains('dropdown-toggle') ){
                        event.target.classList.toggle('toggle-change');
                    }
                    else if(event.target.parentElement.classList.contains('dropdown-toggle')){
                        event.target.parentElement.classList.toggle('toggle-change');
                    }
                })
            });
        </script>
    </head>
    <body>
        <x-navbar/>
        <main class="py-4">
            <div class="container">
                @if(session()->has('success'))
                    <x-alert>{{ session()->get('success') }}</x-alert>
                @endif
                @if(session()->has('error'))
                    <x-alert>{{ session()->get('error') }}</x-alert>
                @endif
            </div>
            @yield('content')
        </main>
        {{-- <x-footer/> --}}
    </body>
</html>
