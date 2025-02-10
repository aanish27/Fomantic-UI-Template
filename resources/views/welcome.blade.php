<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Fomantic</title>

        @vite(['resources/css/app.css', 'resources/js/app.js'])
        <script defer src="https://cdn.jsdelivr.net/npm/fomantic-ui@2.9.3/dist/semantic.min.js"></script>
    </head>
    <body style="background-color: #f9f9f9;">
        <x-guest-nav />
        <section id="main">
            <div class="ui grid middle aligned" >
                <!-- Left Column: Welcome Message -->
                <div class="six wide centered column">
                    <h2 class="ui header">
                        Welcome to Our Platform
                    </h2>
                    <p>
                        Unlock a world of possibilities with our cutting-edge solutions.
                        Whether you're a business owner, a creative mind, or an innovator,
                        we provide the tools you need to thrive in the digital era.
                    </p>
                    <p>
                        Join thousands of satisfied users who trust us to enhance their online experience.
                    </p>
                    <button class="ui huge primary button" >
                        Get Started <i class="arrow right icon"></i>
                    </button>
                </div>
                <!-- Right Column: Features -->
                <div class="six wide centered column">
                    <img class="ui fluid image" src="{{ url('images/img.jpg') }}">
                </div>
            </div>
        </section>

        <div class="ui inverted vertical footer segment center aligned">
            <p>Copyright © 2014–2025 AdminLTE. All rights reserved.</p>
            <a href="#" class="inverted link">Terms & Conditions</a> |
            <a href="#" class="inverted link">Privacy Policy</a>
        </div>

        <script type="module">
            $(function () {

            });
        </script>
    </body>
</html>
