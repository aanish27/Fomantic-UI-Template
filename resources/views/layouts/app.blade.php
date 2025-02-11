<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        @vite(['resources/css/app.css', 'resources/js/app.js'])
        <script defer src="https://cdn.jsdelivr.net/npm/fomantic-ui@2.9.3/dist/semantic.min.js"></script>
    </head>
    <body>
        {{-- sidebar --}}
        <div class="ui left demo vertical inverted labeled icon  sidebar menu ">
            <a class="item">
                <img class="ui centered mini circular image" src="{{ url('images/logo.png') }}">
            </a>
            <a class="item">
                <img class="ui centered mini circular image" src="{{ url('images/profile.jpg') }}">
            </a>
            <a class="item"> <i class="user icon"></i> User </a>
            <a class="item"> <i class="book icon"></i> Books </a>
            <a class="item"> <i class="globe icon"></i> Explore </a>
            <a class="item"> <i class="bookmark icon"></i> Bookmark </a>
        </div>

        <div class="pusher">
            {{-- nav --}}
            <div class="ui secondary menu" style="background-color: whitesmoke; margin-bottom: 0;">
                <a class="item" id="btn_sidebar"> <i class="hamburger icon"></i> </a>
                <a class="item"> Home </a>
                <a class="item"> Contact </a>
                <div class="right menu">
                    <a class="item"> <i class="search icon"></i> </a>
                    <a class="item" href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();"> <i class="sign out alternate icon"></i></i></a>
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                        @csrf
                    </form>
                </div>
            </div>

            <main>
                {{ $slot }}
            </main>

            <div class="ui inverted vertical footer segment center aligned">
                <p>Copyright © 2019 - 2025 VistaG. All rights reserved.</p>
            </div>
        </div>

    <script type="module">
        $(function () {
            $('#btn_sidebar').on('click', function () {
                $('.ui.labeled.icon.sidebar').sidebar('toggle');
            });

            $('.ui.labeled.icon.sidebar').sidebar({
                context: $('body'),
                dimPage: false,
                closable: false
            }).sidebar('attach events', '.sidebar-toggle').sidebar('show')
        });
    </script>
    </body>
</html>
