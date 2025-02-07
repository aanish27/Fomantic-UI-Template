<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Fomantic</title>

        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body style="background-color: #f9f9f9;">
        <div class="ui menu">
            <a class="item">Home</a>
            <a class="item">Contact</a>
            <div class="right menu">
                <a class="item">Sign In</a>
                <a class="item">Sign Up</a>
            </div>
        </div>

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
                    <img class="ui fluid image" src="{{ asset('img.jpg') }}">
                </div>
            </div>
        </sectoin>



        <div class="ui inverted vertical footer segment ">
            <div class="ui container">
                <div> Copyright 2014-2025 AdminLTE. All rights reserved. Privacy Policy Terms & Conditions Privacy Policy </div>
            </div>
        </div>

        <script type="module">
            $(function () {

            });
        </script>
    </body>
</html>
