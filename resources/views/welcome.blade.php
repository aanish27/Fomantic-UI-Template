<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Fomantic</title>

        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="">
        <!-- Sidebar Menu -->
       <div class="ui left demo vertical visible inverted labeled icon sidebar menu ">
            <a class="item">
                <i class="home icon"></i>
                Home
            </a>
            <a class="item">
                <i class="block layout icon"></i>
                Topics
            </a>
            <a class="item">
                <i class="smile icon"></i>
                Friends
            </a>
        </div>

        <div class="ui secondary menu ">
            <a class="active item">
                Home
            </a>
            <a class="item">
                Messages
            </a>
            <a class="item">
                Friends
            </a>
            <div class="right menu">
                <div class="item">
                <div class="ui icon input">
                    <input type="text" placeholder="Search...">
                    <i class="search link icon"></i>
                </div>
                </div>
                <a class="ui item">
                Logout
                </a>
            </div>
        </div>

    <script type="text/javacsript">
       $(function () {
            $('.ui.sidebar').sidebar('toggle');
       });
    </script>
    </body>
</html>
