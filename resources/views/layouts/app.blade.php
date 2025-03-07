<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>
        {{-- <link rel="stylesheet" href="../assets/fomantic-ui/theme-material/dist/semantic.min.css"> --}}
        <link id="theme-link" rel="stylesheet" href="{{ asset('fomantic-ui/theme-material/dist/semantic.min.css') }}">
        <link href="https://cdn.datatables.net/v/se/dt-2.2.2/datatables.min.css" rel="stylesheet" integrity="sha384-cjwec3hxofmN1gxN1H1U8vofTqs5BMuq+EtXidxJd8RgMFqK8PBwxWR10wsojCFT" crossorigin="anonymous">
        @vite(['resources/css/app.css', 'resources/js/app.js'])
        <script defer src="https://cdn.jsdelivr.net/npm/fomantic-ui@2.9.3/dist/semantic.min.js"></script>
    </head>
    <body>
        {{-- sidebar --}}
        <div id="icon_sidebar" class="ui left demo vertical  labeled icon  sidebar menu">
            <a class="item">
                <img class="ui centered mini circular image" src="{{ url('images/logo.png') }}">
            </a>
            <a class="item">
                <img class="ui centered mini circular image" src="{{ url('images/profile.jpg') }}">
            </a>
            <a href="{{ route('employees.index') }}" class="item"> <i class="user icon"></i> Employees </a>
            <a class="item"> <i class="book icon"></i> Books </a>
            <a class="item"> <i class="globe icon"></i> Explore </a>
            <a class="item"> <i class="bookmark icon"></i> Bookmark </a>
        </div>

        <div id="long_sidebar" class="ui sidebar  vertical menu">
            <a class="item">
                <div class="ui two column grid">
                    <div class="left floated  column">Auth::user</div>
                    <div class="right floated column " ><img class="ui mini circular image" src="{{ url('images/logo.png') }}"></div>
                </div>
            </a>
            <a class="item">
                <img class="ui  mini circular image" src="{{ url('images/profile.jpg') }}">
            </a>
            <a href="{{ route('employees.index') }}" class="item"> <i class="user icon"></i> Employees </a>
            <a class="item"> <i class="book icon"></i> Books </a>
            <a class="item"> <i class="globe icon"></i> Explore </a>
            <a class="item"> <i class="bookmark icon"></i> Bookmark </a>
        </div>

        <div class="pusher">
            {{-- nav --}}
            <div class="ui  menu" style="margin-bottom: 0; border-radius:0 ;">
                <a class="item" id="btn_sidebar"> <i class="hamburger icon"></i> </a>
                <a href="{{ route('dashboard') }}" class="item"> Dashboard </a>
                <a class="item"> Home </a>
                <div class="right menu">
                    <select id="theme-selector" class="ui selection dropdown">
                        <option value="">Change Theme</option>
                        <option value="0">Default</option>
                        <option value="1">Material</option>
                        <option value="2">Amazon</option>
                        <option value="3">Github</option>
                    </select>
                    <a class="item ui icon basic" id="darkmode"> <i class="moon icon"></i></i> </a>
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

            <div class="ui vertical footer segment center aligned">
                <p>Copyright © 2019 - 2025 VistaG. All rights reserved.</p>
            </div>
        </div>

    <script type="module">
        $(function () {
            const themes = [
                "{{ asset('fomantic-ui/default/dist/semantic.min.css') }}",
                "{{ asset('fomantic-ui/theme-material/dist/semantic.min.css') }}",
                "{{ asset('fomantic-ui/amazon/dist/semantic.min.css') }}",
                "{{ asset('fomantic-ui/dist/semantic.min.css') }}"
            ];

            let currentThemeIndex = localStorage.getItem("themeIndex") || 0;
            $("#theme-link").attr("href", themes[currentThemeIndex]);

            $("#theme-selector").on("change", function () {
                currentThemeIndex = $(this).val();
                $("#theme-link").attr("href", themes[currentThemeIndex]);
                localStorage.setItem("themeIndex", currentThemeIndex);
                location.reload();
            });


            $('#btn_sidebar').on('click', function () {
                if($('#icon_sidebar').length > 0){
                    showLongSidebar()
                }else{
                    showIconSidebar()
                }

                setTimeout(() => {
                    if (localStorage.getItem('theme') == 'dark') {
                        $('.ui.unstackable.pagination.menu').addClass('inverted');
                    }
                }, 1000);
            });

            setThemeOnLoad()
            function setThemeOnLoad(){
                if (localStorage.getItem('theme') == 'light' || localStorage.getItem('theme') == null ) {
                    toggleLightMode();
                } else {
                    toggleDarkMode();
                }

            }

            $('#darkmode').click(function () {
                if (localStorage.getItem('theme') == 'light' || localStorage.getItem('theme') == undefined ) {
                    toggleDarkMode();
                    localStorage.setItem('theme', 'dark')
                } else {
                    toggleLightMode();
                    localStorage.setItem('theme', 'light');
                }
            });

            function toggleDarkMode () {

                $('body').find('.ui').addClass('inverted');
                $('.pusher').css('background-color' , 'rgba(0, 0, 0, 0.508)')

                setTimeout(() => {
                    $('.dt-input.selection.ui.dropdown').addClass('inverted');
                    $('.ui.unstackable.pagination.menu').addClass('inverted');
                    $(".dt-search").children('span').addClass('inverted transparent icon').css('border' , 'solid 1px white').css('border-radius' , '5px').css('padding', '5px')
                    $('#long_sidebar').addClass('inverted');
                }, 1000);

                // simple toggle icon change
                $("#darkmode > i").removeClass('moon');
                $("#darkmode > i").addClass('sun');
                $(".dt-length").children('label').css('color', 'white')
                $(".dt-search").children('label').css('color', 'white')

                $(".dt-search").children('.dt-search.ui.input').css('color', 'white')
                // $("#dt-search-0").css('padding-top', '5px').css('padding-bottom', '5px').css('background-color', 'rgb(27 28 29)').css('color', 'white')
                $('#myTable_info').css('color', 'white')
            }

            function toggleLightMode () {

                $('body').find('.ui').removeClass('inverted');
                $('.pusher').css('background-color' , '')

                setTimeout(() => {
                    $('.dt-input.selection.ui.dropdown').removeClass('inverted');
                    $('.ui.unstackable.pagination.menu').removeClass('inverted');
                    $(".dt-search").children('span').addClass('inverted transparent icon').css('border' , 'solid 1px black').css('border-radius' , '5px').css('padding', '5px')
                    $('#long_sidebar').removeClass('inverted');
                }, 1000);

                // simple toggle icon change
                $("#darkmode > i").removeClass('sun');
                $("#darkmode > i").addClass('moon');
                $(".dt-length").children('label').css('color', 'black')
                $(".dt-search").children('label').css('color', 'black')

                $(".dt-search").children('.dt-search.ui.input').css('color', 'black')
                // $("#dt-search-0").css('padding-top', '5px').css('padding-bottom', '5px').css('background-color', 'rgb(27 28 29)').css('color', 'black')
                $('#myTable_info').css('color', 'black')
            }

            let longSidebar = null;
            let iconSidebar = null;
            function showLongSidebar() {
                iconSidebar = $('#icon_sidebar');
                iconSidebar.remove();

                $('body').append(longSidebar)
                $('#long_sidebar').removeClass('visible');
                $('.ui.sidebar').sidebar({
                    context: $('body'),
                    dimPage: false,
                    closable: false
                }).sidebar('show')

                setTimeout(() => {
                    $(".sidebar.visible + .pusher").css("width", "calc(100% - 260px)");
                }, 10);
            }

            function showIconSidebar() {
                longSidebar = $('#long_sidebar');
                longSidebar.remove();

                $('body').append(iconSidebar)

                $('#icon_sidebar').removeClass('visible');
                $('.ui.labeled.icon.sidebar').sidebar({
                    context: $('body'),
                    dimPage: false,
                    closable: false
                }).sidebar('show')

                setTimeout(() => {
                    $(".sidebar.visible + .pusher").css("width", "calc(100% - 100px)");
                }, 10);
            }
            showIconSidebar()
        });
    </script>
    </body>
</html>
